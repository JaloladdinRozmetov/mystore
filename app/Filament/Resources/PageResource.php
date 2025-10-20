<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use App\Filament\Resources\PageResource\RelationManagers;


class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'Pages';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')
                ->required()
                ->unique(ignoreRecord: true)
                ->label('Key (e.g. about)'),

            Forms\Components\Tabs::make('Translations')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Uzbek')
                        ->schema([
                            Forms\Components\TextInput::make('title_uz')->label('Title (UZ)'),
                            Forms\Components\RichEditor::make('content_uz')->label('Content (UZ)'),
                        ]),
                    Forms\Components\Tabs\Tab::make('English')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')->label('Title (EN)'),
                            Forms\Components\RichEditor::make('content_en')->label('Content (EN)'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Russian')
                        ->schema([
                            Forms\Components\TextInput::make('title_ru')->label('Title (RU)'),
                            Forms\Components\RichEditor::make('content_ru')->label('Content (RU)'),
                        ]),
                ]),

            Forms\Components\Toggle::make('is_published')->default(true),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')->sortable(),
                Tables\Columns\TextColumn::make('title_en')->label('Title (EN)'),
                Tables\Columns\IconColumn::make('is_published')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('pages_cover')
                    ->conversion('small')
                    ->limit(1)
                    ->square()
                    ->label(''),
            ])->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }
}
