<?php

namespace App\Filament\Resources\ConferenceRegistrationFields;

use App\Filament\Resources\ConferenceRegistrationFields\Pages\ManageConferenceRegistrationFields;
use App\Models\ConferenceRegistrationField;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ConferenceRegistrationFieldResource extends Resource
{
    protected static ?string $model = ConferenceRegistrationField::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Registration';
    protected static ?string $modelLabel = 'Conference Registration Form';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('conference_id')
                    ->relationship('conference', 'title')
                    ->required(),
                TextInput::make('field_key')
                    ->required(),
                TextInput::make('label')
                    ->required(),
                Select::make('field_type')
                    ->options([
            'text' => 'Text',
            'email' => 'Email',
            'select' => 'Select',
            'number' => 'Number',
            'date' => 'Date',
        ])
                    ->required(),
                Toggle::make('is_required')
                    ->required(),
                TextInput::make('options_json'),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('conference.title')
                    ->searchable(),
                TextColumn::make('field_key')
                    ->searchable(),
                TextColumn::make('label')
                    ->searchable(),
                TextColumn::make('field_type')
                    ->badge(),
                IconColumn::make('is_required')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
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
            'index' => ManageConferenceRegistrationFields::route('/'),
        ];
    }
}
