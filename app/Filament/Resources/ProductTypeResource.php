<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductTypeResource\Pages;
use App\Models\ProductType;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductTypeResource extends Resource
{
    protected static ?string $permission = 'catalog:manage-products';

    protected static ?string $model = ProductType::class;
    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    protected static ?int $navigationSort = 2;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Translations')
                    ->columnSpanFull()
                    ->schema([
                        Tabs::make('Locales')->tabs([
                            Tabs\Tab::make('UZ')->schema([
                                TextInput::make('name_uz')
                                    ->label('Name (UZ)')
                                    ->required()
                                    ->maxLength(255)
                                    ->reactive(),
                            ]),
                            Tabs\Tab::make('RU')->schema([
                                TextInput::make('name_ru')
                                    ->label('Name (RU)')
                                    ->maxLength(255),
                            ]),
                            Tabs\Tab::make('EN')->schema([
                                TextInput::make('name')
                                    ->label('Name (EN)')
                                    ->maxLength(255),
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
                TextColumn::make('name_uz')
                    ->label('Name uz')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Name en')
                    ->limit(60)
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('id', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductTypes::route('/'),
            'create' => Pages\CreateProductType::route('/create'),
            'edit' => Pages\EditProductType::route('/{record}/edit'),
        ];
    }
}
