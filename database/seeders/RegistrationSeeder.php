<?php

namespace Database\Seeders;

use App\Models\Checkin;
use App\Models\Conference;
use App\Models\NotificationLog;
use App\Models\Registration;
use App\Models\RegistrationAnswer;
use App\Models\User;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    private const JOHN_EMAIL = 'john.kibuna@example.com';

    public function run(): void
    {
        $johnKibuna = User::where('email', self::JOHN_EMAIL)->firstOrFail();
        $conferences = Conference::with('registrationFields')->orderBy('id')->get();
        $participants = $this->participants();
        $participantUsers = $this->participantUsers($participants);

        foreach ($conferences as $conferenceIndex => $conference) {
            $conferenceParticipants = array_slice($participants, $conferenceIndex * 3, 3);

            foreach ($conferenceParticipants as $participantIndex => $participantData) {
                /** @var \App\Models\User $participant */
                $participant = $participantUsers[$participantData['email']];
                $confirmed = $participantIndex !== 2;

                $registration = Registration::updateOrCreate(
                    [
                        'conference_id' => $conference->id,
                        'participant_id' => $participant->id,
                    ],
                    [
                        'registration_code' => sprintf('CONF-%02d-P%02d', $conference->id, $participantIndex + 1),
                        'status' => 'registered',
                        'confirmed' => $confirmed,
                        'confirmed_at' => $confirmed
                            ? $conference->start_datetime->copy()->subDays(3)->addHours($participantIndex)
                            : null,
                    ],
                );

                $this->seedRegistrationAnswers($conference, $registration, $participant, $participantData);
                $this->seedCheckin($conference, $registration, $johnKibuna->id, $participantIndex, $confirmed);
                $this->seedNotificationLogs($conference, $registration);
            }
        }
    }

    private function participants(): array
    {
        return [
            $this->participant('Akinyi Odhiambo', 'akinyi.odhiambo@example.com', '+254711000101', 'Kisumu', 'LakeTech Events'),
            $this->participant('Brian Njoroge', 'brian.njoroge@example.com', '+254711000102', 'Kiambu', 'Nairobi Dev Community'),
            $this->participant('Catherine Wanjiku', 'catherine.wanjiku@example.com', '+254711000103', 'Nairobi', 'Afya Digital Hub'),
            $this->participant('David Kiptoo', 'david.kiptoo@example.com', '+254711000104', 'Uasin Gishu', 'Rift Valley Innovations'),
            $this->participant('Faith Atieno', 'faith.atieno@example.com', '+254711000105', 'Mombasa', 'Coastline Events'),
            $this->participant('Kevin Mutua', 'kevin.mutua@example.com', '+254711000106', 'Nakuru', 'Savannah Systems'),
        ];
    }

    private function participantUsers(array $participants)
    {
        return collect($participants)->mapWithKeys(function (array $participantData) {
            $user = User::updateOrCreate(
                ['email' => $participantData['email']],
                [
                    'name' => $participantData['name'],
                    'role' => 'participant',
                    'phone' => $participantData['phone'],
                    'email_verified_at' => now(),
                    'password' => 'password',
                ],
            );

            return [$participantData['email'] => $user];
        });
    }

    private function seedRegistrationAnswers(
        Conference $conference,
        Registration $registration,
        User $participant,
        array $participantData,
    ): void {
        $answerMap = [
            'full_name' => $participant->name,
            'email_address' => $participant->email,
            'county' => $participantData['county'],
            'organization' => $participantData['organization'],
        ];

        foreach ($conference->registrationFields as $field) {
            RegistrationAnswer::updateOrCreate(
                [
                    'registration_id' => $registration->id,
                    'field_id' => $field->id,
                ],
                [
                    'value' => $answerMap[$field->field_key] ?? 'N/A',
                ],
            );
        }
    }

    private function seedCheckin(
        Conference $conference,
        Registration $registration,
        int $checkedInBy,
        int $participantIndex,
        bool $confirmed,
    ): void {
        if (! $confirmed) {
            return;
        }

        Checkin::updateOrCreate(
            ['registration_id' => $registration->id],
            [
                'conference_id' => $conference->id,
                'checked_in_at' => $conference->start_datetime->copy()->addMinutes(20 + ($participantIndex * 10)),
                'checked_in_by' => $checkedInBy,
                'checkin_method' => 'qr',
            ],
        );
    }

    private function seedNotificationLogs(Conference $conference, Registration $registration): void
    {
        foreach ($this->notificationSubjects() as $subjectIndex => $subject) {
            NotificationLog::updateOrCreate(
                [
                    'registration_id' => $registration->id,
                    'subject' => $subject,
                ],
                [
                    'conference_id' => $conference->id,
                    'channel' => 'email',
                    'sent_at' => $registration->created_at->copy()->addHours($subjectIndex + 1),
                    'status' => 'sent',
                ],
            );
        }
    }

    private function notificationSubjects(): array
    {
        return [
            'Registration confirmation from John Kibuna',
            'Event reminder from John Kibuna',
        ];
    }

    private function participant(
        string $name,
        string $email,
        string $phone,
        string $county,
        string $organization,
    ): array {
        return [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'county' => $county,
            'organization' => $organization,
        ];
    }
}
