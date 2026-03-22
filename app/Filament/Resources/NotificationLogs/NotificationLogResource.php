<?php

namespace App\Filament\Resources\NotificationLogs;

use App\Filament\Resources\NotificationLogs\Pages\ManageNotificationLogs;
use App\Models\NotificationLog;
use App\Models\Registration;
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

class NotificationLogResource extends Resource
{
    protected static ?string $model = NotificationLog::class;
    protected static string|null|\UnitEnum $navigationGroup = 'Communication';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('conference_id')
                    ->relationship('conference', 'title')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Choose the conference related to this message.'),
                Select::make('registration_id')
                    ->relationship('registration', 'registration_code')
                    ->getOptionLabelFromRecordUsing(fn (Registration $record): string => "{$record->registration_code} - {$record->participant?->name}")
                    ->searchable()
                    ->preload()
                    ->required()
                    ->helperText('Pick the attendee registration that received the notification.'),
                Select::make('channel')
                    ->options(['email' => 'Email'])
                    ->default('email')
                    ->required()
                    ->helperText('Email is the currently supported outbound channel.'),
                TextInput::make('subject')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Use a short subject that admins can scan quickly later.'),
                DateTimePicker::make('sent_at')
                    ->required()
                    ->helperText('When the message was sent or attempted.'),
                Select::make('status')
                    ->options(['sent' => 'Sent', 'failed' => 'Failed'])
                    ->default('sent')
                    ->required()
                    ->helperText('Failed can be used for retries or troubleshooting.'),
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
                TextColumn::make('channel')
                    ->badge(),
                TextColumn::make('subject')
                    ->searchable(),
                TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
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
            'index' => ManageNotificationLogs::route('/'),
        ];
    }
}
