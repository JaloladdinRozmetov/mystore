<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Services';
    protected static ?int    $navigationSort  = 21;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Publish')
                ->columns(3)
                ->schema([
                    ToggleButtons::make('is_active')
                        ->inline()
                        ->options([
                            '0'     => 'Draft',
                            '1' => 'Published',
                        ])
                        ->required()
                        ->default('draft'),

                    DateTimePicker::make('published_at')
                        ->label('Published at')
                        ->seconds(false)
                        ->helperText('Required if status is Published')
                        ->visible(fn ($get) => $get('status') === 'published'),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->helperText('Auto-filled from UZ title; you can edit.')
                        ->maxLength(220)
                        ->unique(ignoreRecord: true),
                ]),

            Section::make('Translations')
                ->columnSpanFull()
                ->schema([
                    Tabs::make('Locales')->tabs([
                        Tabs\Tab::make('UZ')->schema([
                            TextInput::make('title_uz')
                                ->label('Title (UZ)')
                                ->required()
                                ->maxLength(255)
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    if (blank($get('slug'))) {
                                        $set('slug', Str::slug($state));
                                    }
                                }),

                            TextInput::make('excerpt_uz')
                                ->label('Excerpt (UZ)')
                                ->maxLength(255),

                            MarkdownEditor::make('content_uz')
                                ->label('Content (UZ)'),
                        ]),
                        Tabs\Tab::make('RU')->schema([
                            TextInput::make('title_ru')->label('Title (RU)')->maxLength(255),
                            TextInput::make('excerpt_ru')->label('Excerpt (RU)')->maxLength(255),
                            MarkdownEditor::make('content_ru')->label('Content (RU)'),
                        ]),
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('title_en')->label('Title (EN)')->maxLength(255),
                            TextInput::make('excerpt_en')->label('Excerpt (EN)')->maxLength(255),
                            MarkdownEditor::make('content_en')->label('Content (EN)'),
                        ]),
                    ])->persistTabInQueryString(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('title_uz')
                    ->label('Title')
                    ->limit(60)
                    ->searchable(),

                TextColumn::make('excerpt_uz')
                    ->label('Excerpt')
                    ->limit(60)
                    ->searchable(),

                TextColumn::make('is_active')
                    ->badge()
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ])
                    ->sortable(),

                TextColumn::make('slug')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
                SpatieMediaLibraryImageColumn::make('thumb')
                    ->collection('service_cover')
                    ->conversion('small')
                    ->limit(1)
                    ->square()
                    ->label(''),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
                    ]),
                TrashedFilter::make(),
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }

}
