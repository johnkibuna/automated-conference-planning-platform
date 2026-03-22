<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AnnouncementForm
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
                    ->helperText('Choose the conference the update should appear under.'),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('message')
                    ->required()
                    ->rows(5)
                    ->helperText('Publishing a new announcement sends this update by email to everyone already registered for the conference.')
                    ->columnSpanFull(),
                Select::make('type')
                    ->options(['general' => 'General', 'schedule_change' => 'Schedule change', 'delay' => 'Delay'])
                    ->default('general')
                    ->required()
                    ->helperText('Use schedule change or delay when timing is affected.'),
                Select::make('created_by')
                    ->relationship('creator', 'name')
                    ->label('Created by')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Record which admin or organizer published this announcement.'),
            ]);
    }
}
