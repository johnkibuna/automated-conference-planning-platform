<?php

namespace App\Filament\Widgets;

use App\Models\Conference;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class UpcomingConferencesWidget extends TableWidget
{
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Upcoming Conferences';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Conference::query()
                    ->withCount(['registrations', 'sessions'])
                    ->where('status', 'published')
                    ->where('end_datetime', '>=', now())
                    ->orderBy('start_datetime'),
            )
            ->recordUrl(fn (Conference $record): string => route('filament.admin.resources.conferences.edit', ['record' => $record]))
            ->columns([
                TextColumn::make('title')
                    ->weight('bold')
                    ->searchable()
                    ->description(fn (Conference $record): string => $record->venue),
                TextColumn::make('start_datetime')
                    ->label('Starts')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                TextColumn::make('registrations_count')
                    ->label('Attendees')
                    ->badge()
                    ->color('success'),
                TextColumn::make('sessions_count')
                    ->label('Sessions')
                    ->badge()
                    ->color('gray'),
            ])
            ->defaultPaginationPageOption(5)
            ->paginated([5]);
    }
}
