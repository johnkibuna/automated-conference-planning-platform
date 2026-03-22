<?php

namespace App\Filament\Resources\Conferences\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ConferenceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Use the public-facing conference name attendees will recognize.'),
                Textarea::make('description')
                    ->required()
                    ->rows(4)
                    ->helperText('Summarize the event purpose, audience, or key theme.')
                    ->columnSpanFull(),
                TextInput::make('venue')
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('start_datetime')
                    ->required()
                    ->helperText('When the conference officially begins.'),
                DateTimePicker::make('end_datetime')
                    ->required()
                    ->helperText('When the conference officially ends.'),
                DateTimePicker::make('registration_deadline')
                    ->required()
                    ->helperText('After this time, new registrations should stop.'),
                Select::make('status')
                    ->label('Publishing status')
                    ->options(['draft' => 'Draft', 'published' => 'Published', 'closed' => 'Closed'])
                    ->default('draft')
                    ->required()
                    ->helperText('Draft is internal, published is live, and closed prevents new activity.'),
                Select::make('created_by')
                    ->relationship('creator', 'name')
                    ->label('Created by')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Choose the admin or coordinator responsible for this conference.'),
            ]);
    }
}
