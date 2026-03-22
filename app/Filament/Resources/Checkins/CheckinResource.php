<?php

namespace App\Filament\Resources\Checkins;

use App\Filament\Resources\Checkins\Pages\ManageCheckins;
use App\Models\Checkin;
use App\Models\Registration;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CheckinResource extends Resource
{
    protected static ?string $model = Checkin::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Attendance';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('conference_id')
                    ->relationship('conference', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Select the conference where the attendee checked in.'),
                Select::make('registration_id')
                    ->relationship('registration', 'registration_code')
                    ->getOptionLabelFromRecordUsing(fn (Registration $record): string => "{$record->registration_code} - {$record->participant?->name}")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Choose the registration that was checked in.'),
                DateTimePicker::make('checked_in_at')
                    ->required()
                    ->helperText('Record the exact time the attendee arrived.'),
                Select::make('checked_in_by')
                    ->relationship('checkedInBy', 'name')
                    ->label('Checked in by')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Select the staff member or admin who handled the check-in.'),
                Select::make('checkin_method')
                    ->options(['qr' => 'QR'])
                    ->default('qr')
                    ->required()
                    ->helperText('QR is currently the supported check-in method.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('conference.title')
                    ->searchable(),
                TextColumn::make('registration.registration_code')
                    ->label('Registration code')
                    ->searchable(),
                TextColumn::make('registration.participant.name')
                    ->label('Participant')
                    ->searchable(),
                TextColumn::make('checked_in_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('checkedInBy.name')
                    ->label('Checked in by')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('checkin_method')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCheckins::route('/'),
        ];
    }
}
