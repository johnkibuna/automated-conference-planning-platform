<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentRegistrationsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Recent Registrations';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Registration::query()
                    ->with(['conference', 'participant'])
                    ->latest(),
            )
            ->recordUrl(fn (Registration $record): string => route('filament.admin.resources.registrations.edit', ['record' => $record]))
            ->columns([
                TextColumn::make('participant.name')
                    ->label('Attendee')
                    ->weight('bold')
                    ->searchable()
                    ->description(fn (Registration $record): string => $record->conference?->title ?? 'Conference'),
                TextColumn::make('registration_code')
                    ->label('Code')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                IconColumn::make('confirmed')
                    ->label('Confirmed')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Registered')
                    ->since()
                    ->sortable(),
            ])
            ->defaultPaginationPageOption(6)
            ->paginated([6]);
    }
}
