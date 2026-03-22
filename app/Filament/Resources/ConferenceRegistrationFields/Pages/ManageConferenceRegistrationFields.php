<?php

namespace App\Filament\Resources\ConferenceRegistrationFields\Pages;

use App\Filament\Resources\ConferenceRegistrationFields\ConferenceRegistrationFieldResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageConferenceRegistrationFields extends ManageRecords
{
    protected static string $resource = ConferenceRegistrationFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
