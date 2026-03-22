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
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Select the conference the attendee is registering for.'),
                Select::make('participant_id')
                    ->relationship('participant', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Pick the participant account linked to this registration.'),
                TextInput::make('registration_code')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Use a unique code for check-in and admin tracking.'),
                Select::make('status')
                    ->options(['registered' => 'Registered', 'cancelled' => 'Cancelled'])
                    ->default('registered')
                    ->required()
                    ->helperText('Cancelled registrations stay in history but are no longer active.'),
                Toggle::make('confirmed')
                    ->required()
                    ->helperText('Turn this on once the registration has been verified or approved.'),
                DateTimePicker::make('confirmed_at')
                    ->helperText('Optional. Set the time when confirmation happened.'),
            ]);
    }
}
