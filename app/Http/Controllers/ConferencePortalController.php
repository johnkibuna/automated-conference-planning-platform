<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\SessionMaterial;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConferencePortalController extends Controller
{
    public function show(Conference $conference, string $registrationCode): View
    {
        $registration = Registration::query()
            ->with([
                'participant',
                'checkin',
                'answers.field',
                'conference.announcements' => fn ($query) => $query->latest(),
                'conference.sessions' => fn ($query) => $query->with(['speaker', 'materials'])->orderBy('start_time'),
            ])
            ->where('conference_id', $conference->id)
            ->where('registration_code', $registrationCode)
            ->firstOrFail();

        $sessions = $registration->conference->sessions;
        $announcements = $registration->conference->announcements;
        $materialsCount = $sessions->flatMap->materials->count();

        return view('conferences.portal', [
            'conference' => $registration->conference,
            'registration' => $registration,
            'sessions' => $sessions,
            'announcements' => $announcements,
            'materialsCount' => $materialsCount,
            'isHybrid' => $sessions->contains(fn ($session) => filled($session->online_link)),
            'qrCodeDataUri' => $this->qrCodeSvg(
                route('conferences.checkin.show', [
                    'conference' => $conference,
                    'registrationCode' => $registration->registration_code,
                ]),
            ),
        ]);
    }

    public function material(Conference $conference, string $registrationCode, SessionMaterial $material)
    {
        $registration = Registration::query()
            ->where('conference_id', $conference->id)
            ->where('registration_code', $registrationCode)
            ->firstOrFail();

        abort_unless($material->session?->conference_id === $conference->id, 404);

        $path = $material->file_path;

        if (blank($path)) {
            abort(404);
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return redirect()->away($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return redirect(Storage::disk('public')->url($path));
        }

        if (Storage::disk(config('filesystems.default'))->exists($path)) {
            return Storage::disk(config('filesystems.default'))->download($path, $material->file_name);
        }

        if (Str::startsWith($path, 'seeded-materials/')) {
            $content = implode(PHP_EOL, [
                $material->file_name,
                "Conference: {$conference->title}",
                "Session: {$material->session?->title}",
                '',
                'This is a seeded demo material placeholder for the attendee portal.',
                'Replace this with a real uploaded file or an external document link in admin when you are ready.',
            ]);

            return response()->streamDownload(
                static function () use ($content): void {
                    echo $content;
                },
                pathinfo($material->file_name, PATHINFO_FILENAME) . '-demo.txt',
                ['Content-Type' => 'text/plain; charset=UTF-8'],
            );
        }

        abort(404, 'This material is not available for download yet.');
    }

    private function qrCodeSvg(string $payload): string
    {
        $options = new \chillerlan\QRCode\QROptions([
            'outputType' => \chillerlan\QRCode\QRCode::OUTPUT_IMAGE_PNG,
            'imageBase64' => true,
            'eccLevel' => \chillerlan\QRCode\QRCode::ECC_M,
            'scale' => 6,
            'addQuietzone' => true,
        ]);

        return (new \chillerlan\QRCode\QRCode($options))->render($payload);
    }
}
