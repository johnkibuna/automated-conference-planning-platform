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
                    ->required(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('speaker_id')
                    ->relationship('speaker', 'name'),
                DateTimePicker::make('start_time')
                    ->required(),
                DateTimePicker::make('end_time')
                    ->required(),
                TextInput::make('session_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options([
            'scheduled' => 'Scheduled',
            'delayed' => 'Delayed',
            'ongoing' => 'Ongoing',
            'completed' => 'Completed',
        ])
                    ->default('scheduled')
                    ->required(),
            ]);
    }
}
