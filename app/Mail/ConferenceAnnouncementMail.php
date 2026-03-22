<?php

namespace App\Mail;

use App\Models\Announcement;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConferenceAnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Announcement $announcement,
        public Registration $registration,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "{$this->announcement->conference->title}: {$this->announcement->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.conferences.announcement',
        );
    }
}
