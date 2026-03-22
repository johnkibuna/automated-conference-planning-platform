<?php

namespace App\Filament\Resources\RegistrationAnswers;

use App\Filament\Resources\RegistrationAnswers\Pages\ManageRegistrationAnswers;
use App\Models\ConferenceRegistrationField;
use App\Models\Registration;
use App\Models\RegistrationAnswer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RegistrationAnswerResource extends Resource
{
    protected static ?string $model = RegistrationAnswer::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Registration';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('registration_id')
                    ->relationship('registration', 'registration_code')
                    ->getOptionLabelFromRecordUsing(fn (Registration $record): string => "{$record->registration_code} - {$record->participant?->name}")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Pick the attendee registration this answer belongs to.'),
                Select::make('field_id')
                    ->relationship('field', 'label')
                    ->getOptionLabelFromRecordUsing(fn (ConferenceRegistrationField $record): string => "{$record->label} ({$record->field_key})")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Choose the registration form field being answered.'),
                Textarea::make('value')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration.registration_code')
                    ->label('Registration code')
                    ->searchable(),
                TextColumn::make('registration.participant.name')
                    ->label('Participant')
                    ->searchable(),
                TextColumn::make('field.label')
                    ->label('Form field')
                    ->searchable(),
                TextColumn::make('value')
                    ->limit(50)
                    ->searchable(),
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
            'index' => ManageRegistrationAnswers::route('/'),
        ];
    }
}
