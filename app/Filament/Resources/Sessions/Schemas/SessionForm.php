<?php

namespace App\Filament\Resources\Sessions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SessionForm
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
                    ->helperText('Pick the conference this session belongs to.'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->rows(4)
                    ->helperText('Capture the focus of the session for admins and speakers.')
                    ->columnSpanFull(),
                TextInput::make('online_link')
                    ->label('Online session link')
                    ->url()
                    ->helperText('Optional. Add a Zoom, Meet, Teams, or livestream link if attendees should be able to join online.'),
                Select::make('speaker_id')
                    ->relationship('speaker', 'name')
                    ->searchable()
                    ->preload()
                    ->helperText('Optional if the session has not been assigned yet.'),
                DateTimePicker::make('start_time')
                    ->required()
                    ->helperText('Session start time.'),
                DateTimePicker::make('end_time')
                    ->required()
                    ->helperText('Session end time.'),
                TextInput::make('session_order')
                    ->label('Agenda order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear earlier in the running order.'),
                Select::make('status')
                    ->options([
            'scheduled' => 'Scheduled',
            'delayed' => 'Delayed',
            'ongoing' => 'Ongoing',
            'completed' => 'Completed',
        ])
                    ->default('scheduled')
                    ->required()
                    ->helperText('Use this to reflect the current delivery status on the day.'),
            ]);
    }
}
