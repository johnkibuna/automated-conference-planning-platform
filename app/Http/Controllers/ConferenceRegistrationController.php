<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\RegistrationAnswer;
use App\Models\User;
use App\Services\ConferenceNotificationService;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ConferenceRegistrationController extends Controller
{
    public function create(Conference $conference): View
    {
        $conference->load(['registrationFields' => fn ($query) => $query->orderBy('sort_order')]);

        return view('conferences.register', [
            'conference' => $conference,
            'registrationFields' => $conference->registrationFields,
            'registrationClosed' => $this->registrationClosed($conference),
        ]);
    }

    public function store(Request $request, Conference $conference): RedirectResponse
    {
        $conference->load(['registrationFields' => fn ($query) => $query->orderBy('sort_order')]);
        $registration = null;

        if ($this->registrationClosed($conference)) {
            throw ValidationException::withMessages([
                'conference' => 'Registration for this conference is currently closed.',
            ]);
        }

        if ($conference->registrationFields->isEmpty()) {
            throw ValidationException::withMessages([
                'conference' => 'Registration is not available yet for this conference.',
            ]);
        }

        $validated = Validator::make(
            $request->all(),
            $this->rulesFor($conference),
            [],
            $this->attributesFor($conference),
        )->validate();

        $answers = collect($validated['answers'] ?? []);
        $identity = $this->resolveParticipantIdentity($answers);

        DB::transaction(function () use ($conference, $answers, $identity, &$registration): void {
            $participant = $this->upsertParticipant($identity);

            $registration = Registration::query()
                ->where('conference_id', $conference->id)
                ->where('participant_id', $participant->id)
                ->first();

            if (! $registration) {
                $registration = Registration::create([
                    'conference_id' => $conference->id,
                    'participant_id' => $participant->id,
                    'registration_code' => $this->generateRegistrationCode(),
                    'status' => 'registered',
                    'confirmed' => true,
                    'confirmed_at' => now(),
                ]);
            }

            foreach ($conference->registrationFields as $field) {
                RegistrationAnswer::updateOrCreate(
                    [
                        'registration_id' => $registration->id,
                        'field_id' => $field->id,
                    ],
                    [
                        'value' => (string) ($answers->get($field->field_key) ?? ''),
                    ],
                );
            }
        });

        app(ConferenceNotificationService::class)->sendRegistrationConfirmation($registration);

        return redirect()->route('conferences.registration.success', [
            'conference' => $conference,
            'registrationCode' => $registration->registration_code,
        ]);
    }

    public function success(Conference $conference, string $registrationCode): View
    {
        $registration = Registration::query()
            ->with(['participant', 'answers.field'])
            ->where('conference_id', $conference->id)
            ->where('registration_code', $registrationCode)
            ->firstOrFail();

        return view('conferences.registration-success', [
            'conference' => $conference,
            'registration' => $registration,
            'qrCodeDataUri' => $this->qrCodeSvg(
                route('conferences.checkin.show', [
                    'conference' => $conference,
                    'registrationCode' => $registration->registration_code,
                ])
            ),
        ]);
    }

    private function rulesFor(Conference $conference): array
    {
        $rules = [];

        foreach ($conference->registrationFields as $field) {
            $baseRules = $field->is_required ? ['required'] : ['nullable'];

            $rules["answers.{$field->field_key}"] = match ($field->field_type) {
                'email' => [...$baseRules, 'email', 'max:255'],
                'number' => [...$baseRules, 'numeric'],
                'date' => [...$baseRules, 'date'],
                'select' => [...$baseRules, Rule::in($field->options_json ?? [])],
                default => [...$baseRules, 'string', 'max:255'],
            };
        }

        return $rules;
    }

    private function attributesFor(Conference $conference): array
    {
        return $conference->registrationFields
            ->mapWithKeys(fn ($field) => ["answers.{$field->field_key}" => $field->label])
            ->all();
    }

    private function resolveParticipantIdentity($answers): array
    {
        $name = $this->firstMatchingAnswer($answers, ['full_name', 'name', 'participant_name']);
        $email = $this->firstMatchingAnswer($answers, ['email_address', 'email', 'participant_email']);
        $phone = $this->firstMatchingAnswer($answers, ['phone', 'phone_number', 'mobile_number']);

        $messages = [];

        if (blank($name)) {
            $messages['answers.full_name'] = 'Add a name field to the registration form and fill it in before submitting.';
        }

        if (blank($email)) {
            $messages['answers.email_address'] = 'Add an email field to the registration form and fill it in before submitting.';
        }

        if ($messages !== []) {
            throw ValidationException::withMessages($messages);
        }

        return [
            'name' => $name,
            'email' => Str::lower($email),
            'phone' => $phone,
        ];
    }

    private function firstMatchingAnswer($answers, array $keys): ?string
    {
        foreach ($keys as $key) {
            $value = $answers->get($key);

            if (filled($value)) {
                return trim((string) $value);
            }
        }

        return null;
    }

    private function upsertParticipant(array $identity): User
    {
        $participant = User::firstOrNew(['email' => $identity['email']]);

        $participant->name = $identity['name'];
        $participant->phone = $identity['phone'];

        if (! $participant->exists) {
            $participant->role = 'participant';
            $participant->password = Str::password(16);
            $participant->email_verified_at = now();
        }

        $participant->save();

        return $participant;
    }

    private function generateRegistrationCode(): string
    {
        do {
            $code = 'SUM-' . Str::upper(Str::random(8));
        } while (Registration::where('registration_code', $code)->exists());

        return $code;
    }

    private function registrationClosed(Conference $conference): bool
    {
        return $conference->status !== 'published'
            || ($conference->registration_deadline && $conference->registration_deadline->isPast());
    }

    private function qrCodeSvg(string $payload): string
    {
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel' => QRCode::ECC_M,
            'scale' => 6,
            'addQuietzone' => true,
        ]);

        return (new QRCode($options))->render($payload);
    }
}
