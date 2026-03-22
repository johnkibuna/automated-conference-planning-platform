<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('conference_id')
                    ->relationship('conference', 'title')
                    ->required(),
                Select::make('participant_id')
                    ->relationship('participant', 'name')
                    ->required(),
                TextInput::make('registration_code')
                    ->required(),
                Select::make('status')
                    ->options(['registered' => 'Registered', 'cancelled' => 'Cancelled'])
                    ->default('registered')
                    ->required(),
                Toggle::make('confirmed')
                    ->required(),
                DateTimePicker::make('confirmed_at'),
            ]);
    }
}
