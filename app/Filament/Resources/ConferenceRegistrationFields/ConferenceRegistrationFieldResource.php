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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ConferenceRegistrationFieldResource extends Resource
{
    protected static ?string $model = ConferenceRegistrationField::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Registration';
    protected static ?string $modelLabel = 'Registration Form Field';
    protected static ?string $pluralModelLabel = 'Registration Form Fields';
    protected static ?string $navigationLabel = 'Registration Form Builder';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('conference_id')
                    ->relationship('conference', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Choose the conference whose registration form this question belongs to.'),
                TextInput::make('label')
                    ->label('Question label')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state): void {
                        $currentKey = (string) $get('field_key');
                        $oldGeneratedKey = Str::of((string) $old)->snake()->toString();

                        if (blank($currentKey) || ($currentKey === $oldGeneratedKey)) {
                            $set('field_key', Str::of((string) $state)->snake()->toString());
                        }
                    })
                    ->helperText('This is the question text attendees will read on the form.'),
                TextInput::make('field_key')
                    ->label('System key')
                    ->required()
                    ->placeholder('Auto-generated, for example full_name')
                    ->helperText('Usually auto-filled from the question label.'),
                Select::make('field_type')
                    ->label('Answer format')
                    ->options([
                        'text' => 'Short text',
                        'email' => 'Email address',
                        'select' => 'Dropdown list',
                        'number' => 'Number',
                        'date' => 'Date',
                    ])
                    ->live()
                    ->afterStateUpdated(function (Set $set, ?string $state): void {
                        if ($state !== 'select') {
                            $set('options_json', null);
                        }
                    })
                    ->required()
                    ->helperText('Choose how attendees should answer this question.'),
                Textarea::make('options_json')
                    ->label('Dropdown choices')
                    ->rows(5)
                    ->placeholder("Nairobi\nMombasa\nKisumu")
                    ->helperText('Only used for dropdown list questions. Add one choice per line.')
                    ->visible(fn (Get $get): bool => $get('field_type') === 'select')
                    ->formatStateUsing(function ($state): string {
                        if (blank($state)) {
                            return '';
                        }

                        return is_array($state) ? implode(PHP_EOL, $state) : (string) $state;
                    })
                    ->dehydrateStateUsing(function ($state): ?array {
                        $options = preg_split('/\r\n|\r|\n/', (string) $state) ?: [];
                        $options = array_values(array_filter(array_map('trim', $options)));

                        return $options === [] ? null : $options;
                    }),
                Toggle::make('is_required')
                    ->label('Required question')
                    ->required()
                    ->helperText('Turn this on if attendees must answer before submitting.'),
                TextInput::make('sort_order')
                    ->label('Display order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->helperText('Lower numbers appear earlier on the registration form.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->description('These questions appear on the public event registration form, in the same order shown here.')
            ->defaultGroup(
                Group::make('conference.title')
                    ->label('Conference')
                    ->titlePrefixedWithLabel(false)
                    ->collapsible()
                    ->getDescriptionFromRecordUsing(fn (ConferenceRegistrationField $record): string => 'Registration form fields'),
            )
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('label')
                    ->label('Field')
                    ->description(fn (ConferenceRegistrationField $record): string => "System key: {$record->field_key}")
                    ->searchable(),
                TextColumn::make('field_type')
                    ->label('Type')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'text' => 'Short text',
                        'email' => 'Email address',
                        'select' => 'Dropdown list',
                        'number' => 'Number',
                        'date' => 'Date',
                        default => $state,
                    })
                    ->badge(),
                TextColumn::make('choices_preview')
                    ->label('Choices')
                    ->state(fn (ConferenceRegistrationField $record): string => $record->field_type === 'select'
                        ? (filled($record->options_json) ? implode(', ', $record->options_json) : 'No choices added')
                        : 'Not a dropdown')
                    ->wrap(),
                IconColumn::make('is_required')
                    ->label('Required')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('conference.title')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                EditAction::make()
                    ->modalWidth('3xl'),
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
