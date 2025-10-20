<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\NewsResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon  = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'News';
    protected static ?int    $navigationSort  = 20;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Publish')
                ->columns(3)
                ->schema([
                    ToggleButtons::make('status')
                        ->inline()
                        ->options([
                            'draft'     => 'Draft',
                            'published' => 'Published',
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
                                        $set('slug', \Illuminate\Support\Str::slug($state));
                                    }
                                }),
                            TextInput::make('excerpt_uz')
                                ->label('Excerpt (UZ)')
                                ->required()
                                ->maxLength(255),
                            MarkdownEditor::make('description_uz')
                                ->label('Description (UZ)')
                                ->required(),
                        ]),
                        Tabs\Tab::make('RU')->schema([
                            TextInput::make('title_ru')->label('Title (RU)')->maxLength(255),
                            TextInput::make('excerpt_ru')->label('Excerpt (RU)')->maxLength(255),
                            MarkdownEditor::make('description_ru')->label('Description (RU)'),
                        ]),
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('title_en')->label('Title (EN)')->maxLength(255),
                            TextInput::make('excerpt_en')->label('Excerpt (EN)')->maxLength(255),
                            MarkdownEditor::make('description_en')->label('Description (EN)'),
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

                // Table shows only UZ (no localization here)
                TextColumn::make('title_uz')
                    ->label('Title')
                    ->limit(60)
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ])
                    ->sortable(),

                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('author.name')
                    ->label('Author')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('slug')
                    ->limit(30)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(['draft' => 'Draft', 'published' => 'Published']),
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
        // Keep default; TrashedFilter handles soft deletes
        return parent::getEloquentQuery();
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit'   => Pages\EditNews::route('/{record}/edit'),
            'view'   => Pages\ViewNews::route('/{record}'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }
}
