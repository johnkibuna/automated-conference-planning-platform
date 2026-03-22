<?php

namespace App\Services;

use App\Mail\ConferenceAnnouncementMail;
use App\Mail\ConferenceRegistrationConfirmedMail;
use App\Models\Announcement;
use App\Models\NotificationLog;
use App\Models\Registration;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ConferenceNotificationService
{
    public function sendRegistrationConfirmation(Registration $registration): bool
    {
        $registration->loadMissing(['conference', 'participant']);

        return $this->deliver(
            $registration,
            "Registration confirmed for {$registration->conference->title}",
            new ConferenceRegistrationConfirmedMail($registration),
        );
    }

    public function sendAnnouncementToAttendees(Announcement $announcement): int
    {
        $announcement->loadMissing(['conference', 'creator']);

        $registrations = Registration::query()
            ->with(['conference', 'participant'])
            ->where('conference_id', $announcement->conference_id)
            ->where('status', 'registered')
            ->get();

        $sentCount = 0;

        foreach ($registrations as $registration) {
            if ($this->deliver(
                $registration,
                $announcement->title,
                new ConferenceAnnouncementMail($announcement, $registration),
            )) {
                $sentCount++;
            }
        }

        return $sentCount;
    }

    private function deliver(Registration $registration, string $subject, Mailable $mailable): bool
    {
        $email = $registration->participant?->email;

        if (blank($email)) {
            $this->logDelivery($registration, $subject, 'failed');

            return false;
        }

        try {
            Mail::to($email)->send($mailable);

            $this->logDelivery($registration, $subject, 'sent');

            return true;
        } catch (Throwable $exception) {
            report($exception);

            $this->logDelivery($registration, $subject, 'failed');

            return false;
        }
    }

    private function logDelivery(Registration $registration, string $subject, string $status): void
    {
        NotificationLog::updateOrCreate(
            [
                'conference_id' => $registration->conference_id,
                'registration_id' => $registration->id,
                'subject' => $subject,
            ],
            [
                'channel' => 'email',
                'sent_at' => now(),
                'status' => $status,
            ],
        );
    }
}
