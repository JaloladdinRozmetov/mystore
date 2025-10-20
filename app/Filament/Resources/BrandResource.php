<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandResource\Pages;
use App\Filament\Resources\BrandResource\RelationManagers;
use App\Models\Brand;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Brands';
    protected static ?string $navigationGroup = 'Catalog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Use tabs for locales (optional UX nicety)
                Tabs::make('Locales')
                    ->tabs([
                        Tabs\Tab::make('EN')->schema([
                            TextInput::make('name')
                                ->label('Name (EN)')
                                ->required()
                                ->maxLength(255),
                        ]),
                        Tabs\Tab::make('RU')->schema([
                            TextInput::make('name_ru')
                                ->label('Name (RU)')
                                ->maxLength(255),
                        ]),
                        Tabs\Tab::make('UZ')->schema([
                            TextInput::make('name_uz')
                                ->label('Name (UZ)')
                                ->maxLength(255),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable()->toggleable(false),
                TextColumn::make('name')->label('EN')->searchable()->sortable(),
                TextColumn::make('name_ru')->label('RU')->searchable()->sortable(),
                TextColumn::make('name_uz')->label('UZ')->searchable()->sortable(),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('brand_cover')
                    ->conversion('small')
                    ->limit(1)
                    ->square()
                    ->label(''),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * When sorting the computed 'locale_name' column, map it to the appropriate DB column.
     */
    protected static function applyLocaleSort($query, $direction)
    {
        $locale = app()->getLocale();

        $column = match ($locale) {
            'ru' => 'name_ru',
            'uz' => 'name_uz',
            default => 'name',
        };

        $query->orderBy($column, $direction);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrands::route('/'),
            'create' => Pages\CreateBrand::route('/create'),
            'edit' => Pages\EditBrand::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }
}
