<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OurTeamResource\Pages;
use App\Filament\Resources\OurTeamResource\RelationManagers\MediaRelationManager;
use App\Models\OurTeam;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OurTeamResource extends Resource
{
    protected static ?string $model = OurTeam::class;
    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Our Team';
    protected static ?string $pluralModelLabel = 'Team Members';
    protected static ?string $modelLabel = 'Team Member';
    protected static ?int $navigationSort = 20;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Locales')
                    ->tabs([
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('name_en')
                                ->label('Name (EN)')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('job_title_en')
                                ->label('Job title (EN)')
                                ->required()
                                ->maxLength(255),
                        ]),
                        Tabs\Tab::make('RU')->schema([
                            TextInput::make('name_ru')
                                ->label('Name (RU)')
                                ->maxLength(255),
                            TextInput::make('job_title_ru')
                                ->label('Job title (RU)')
                                ->required()
                                ->maxLength(255),
                        ]),
                        Tabs\Tab::make('UZ')->schema([
                            TextInput::make('name_uz')
                                ->label('Name (UZ)')
                                ->maxLength(255),
                            TextInput::make('job_title_uz')
                                ->label('Job title (UZ)')
                                ->required()
                                ->maxLength(255),
                        ]),
                    ]),
                    Repeater::make('social_links')
                        ->label('Social Links')
                        ->hint('Add platform and URL (stored as JSON).')
                        ->schema([
                            TextInput::make('platform')
                                ->label('Platform')
                                ->required()
                                ->maxLength(100),
                            TextInput::make('url')
                                ->label('URL')
                                ->required()
                                ->url()
                                ->maxLength(2000),
                        ])
                        ->columns(2)
                        ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover')
                    ->label('Cover')
                    ->getStateUsing(function (OurTeam $record) {
                        return $record->getFirstMediaUrl('team_cover') ?: null;
                    })
                    ->square(),

                TextColumn::make('name_uz')->label('Name')->sortable(),
                TextColumn::make('job_title_uz')->label('Job'),

                // Show count of gallery images:
                TextColumn::make('media_count')
                    ->label('Images')
                    ->getStateUsing(fn (OurTeam $record) => $record->media()->count())
                    ->sortable(),

                TextColumn::make('created_at')->dateTime()->label('Created'),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOurTeams::route('/'),
            'create' => Pages\CreateOurTeam::route('/create'),
            'edit' => Pages\EditOurTeam::route('/{record}/edit'),
        ];
    }
}
