<?php

namespace App\Filament\Resources\RegistrationAnswers\Pages;

use App\Filament\Resources\RegistrationAnswers\RegistrationAnswerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRegistrationAnswers extends ManageRecords
{
    protected static string $resource = RegistrationAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
