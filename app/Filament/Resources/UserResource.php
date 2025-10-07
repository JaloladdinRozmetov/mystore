<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Catalog';
    protected static ?int $navigationSort = 10;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Section::make('Profile')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Full name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    // Password handled safely on create/edit
                    TextInput::make('password')
                        ->password()
                        ->revealable()
                        ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                        ->dehydrated(fn ($state) => filled($state)) // only send to model if user typed something
                        ->required(fn (string $context) => $context === 'create')
                        ->rule('min:8')
                        ->helperText(fn (string $context) => $context === 'edit'
                            ? 'Leave blank to keep the current password.'
                            : null),

                    DateTimePicker::make('email_verified_at')
                        ->label('Email verified at')
                        ->native(false)
                        ->seconds(false)
                        ->timezone(config('app.timezone'))
                        ->helperText('Set/clear to mark user as verified/unverified.'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),


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
                Filter::make('verified')
                    ->label('Verified users')
                    ->query(fn (Builder $q) => $q->whereNotNull('email_verified_at')),

                Filter::make('unverified')
                    ->label('Unverified users')
                    ->query(fn (Builder $q) => $q->whereNull('email_verified_at')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('verify')
                    ->label('Verify')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->email_verified_at))
                    ->action(fn (User $record) => $record->forceFill(['email_verified_at' => now()])->save()),

                Tables\Actions\Action::make('unverify')
                    ->label('Unverify')
                    ->icon('heroicon-m-x-mark')
                    ->color('warning')
                    ->visible(fn ($record) => ! is_null($record->email_verified_at))
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->forceFill(['email_verified_at' => null])->save()),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // 🚫 disable create
    }

    public static function canEdit($record): bool
    {
        return false; // 🚫 disable edit
    }

    public static function canDelete($record): bool
    {
        return false; // 🚫 disable delete
    }
}
