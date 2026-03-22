<?php

namespace App\Filament\Resources\Checkins;

use App\Filament\Resources\Checkins\Pages\ManageCheckins;
use App\Models\Checkin;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
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
                    ->required(),
                Select::make('registration_id')
                    ->relationship('registration', 'id')
                    ->required(),
                DateTimePicker::make('checked_in_at')
                    ->required(),
                TextInput::make('checked_in_by')
                    ->required()
                    ->numeric(),
                Select::make('checkin_method')
                    ->options(['qr' => 'Qr'])
                    ->default('qr')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('conference.title')
                    ->searchable(),
                TextColumn::make('registration.id')
                    ->searchable(),
                TextColumn::make('checked_in_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('checked_in_by')
                    ->numeric()
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
