<?php

namespace App\Filament\Resources\Announcements\Pages;

use App\Filament\Resources\Announcements\AnnouncementResource;
use App\Services\ConferenceNotificationService;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;

    protected function afterCreate(): void
    {
        $sentCount = app(ConferenceNotificationService::class)->sendAnnouncementToAttendees($this->record);

        Notification::make()
            ->title($sentCount > 0 ? 'Announcement emailed to attendees' : 'Announcement saved')
            ->body($sentCount > 0
                ? "This update was emailed to {$sentCount} registered attendee(s)."
                : 'There are no registered attendees to email yet, so the update was only saved in the system.')
            ->success()
            ->send();
    }
}
