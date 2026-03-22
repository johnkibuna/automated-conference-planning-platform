<?php

namespace App\Filament\Resources\Conferences\Pages;

use App\Filament\Resources\Conferences\ConferenceResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConference extends EditRecord
{
    protected static string $resource = ConferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('openCheckinDesk')
                ->label('Open Check-In Desk')
                ->icon('heroicon-o-qr-code')
                ->color('primary')
                ->url(fn (): string => route('conferences.checkin.desk', $this->getRecord()), shouldOpenInNewTab: true),
            DeleteAction::make(),
        ];
    }
}
