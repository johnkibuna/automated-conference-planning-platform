<?php

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SpeakerForm
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
                    ->helperText('Link the speaker to the conference where they will appear.'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->helperText('Optional, but useful for speaker coordination.'),
                Textarea::make('bio')
                    ->rows(4)
                    ->helperText('Add a short speaker profile that admins can reference later.')
                    ->columnSpanFull(),
            ]);
    }
}
