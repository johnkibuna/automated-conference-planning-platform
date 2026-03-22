<?php

namespace App\Filament\Resources\SessionMaterials;

use App\Filament\Resources\SessionMaterials\Pages\ManageSessionMaterials;
use App\Models\SessionMaterial;
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

class SessionMaterialResource extends Resource
{
    protected static ?string $model = SessionMaterial::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Event Management';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('session_id')
                    ->relationship('session', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Link the file to the session where it should be available.'),
                TextInput::make('file_name')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Use a clear filename such as agenda.pdf or keynote-slides.pptx.'),
                TextInput::make('file_path')
                    ->required()
                    ->helperText('Store the relative or full path used by your file storage setup.'),
                TextInput::make('file_type')
                    ->required()
                    ->helperText('Examples: pdf, pptx, docx.'),
                DateTimePicker::make('uploaded_at')
                    ->required()
                    ->helperText('When the file became available to the team.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('session.conference.title')
                    ->label('Conference')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('session.title')
                    ->searchable(),
                TextColumn::make('file_name')
                    ->searchable(),
                TextColumn::make('file_path')
                    ->searchable(),
                TextColumn::make('file_type')
                    ->searchable(),
                TextColumn::make('uploaded_at')
                    ->dateTime()
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
            'index' => ManageSessionMaterials::route('/'),
        ];
    }
}
