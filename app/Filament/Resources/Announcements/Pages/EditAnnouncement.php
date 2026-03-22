<?php

namespace App\Filament\Resources\Announcements\Pages;

use App\Filament\Resources\Announcements\AnnouncementResource;
use App\Services\ConferenceNotificationService;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditAnnouncement extends EditRecord
{
    protected static string $resource = AnnouncementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('sendEmails')
                ->label('Send Update Emails')
                ->icon('heroicon-o-paper-airplane')
                ->color('primary')
                ->requiresConfirmation()
                ->modalHeading('Email this update to attendees?')
                ->modalDescription('Use this after editing an announcement when you want registered attendees to receive the latest version by email.')
                ->action(function (): void {
                    $sentCount = app(ConferenceNotificationService::class)->sendAnnouncementToAttendees($this->record);

                    Notification::make()
                        ->title($sentCount > 0 ? 'Update emails sent' : 'No emails sent')
                        ->body($sentCount > 0
                            ? "This announcement was emailed to {$sentCount} registered attendee(s)."
                            : 'There are no registered attendees to email yet for this conference.')
                        ->success()
                        ->send();
                }),
            DeleteAction::make(),
        ];
    }
}
