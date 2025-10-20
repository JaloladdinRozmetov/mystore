<?php

namespace App\Filament\Resources\BrandResource\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Filament\Tables;
use Filament\Forms;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    protected static ?string $title = 'Media';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Name')->required(),
            Forms\Components\Textarea::make('custom_properties.caption')->label('Caption'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('preview')
                    ->label('Preview')
                    ->getStateUsing(fn (Media $record) => $record->getUrl('thumb') ?: $record->getUrl()),
                Tables\Columns\TextColumn::make('collection_name')->label('Collection'),
                Tables\Columns\TextColumn::make('custom_properties.alt')->label('Alt'),
                Tables\Columns\TextColumn::make('order_column')->label('Order')->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('createMedia')
                    ->label('Add Media')
                    ->modalHeading('Upload Media')
                    ->form([
                        Select::make('collection_name')
                            ->label('Collection')
                            ->options([
                                'brand_cover'   => 'Cover (single)',
                                'brand_gallery' => 'Gallery',
                            ])
                            ->default('brand_gallery')
                            ->required(),


                        FileUpload::make('file')
                            ->label('Image')
                            ->image()
                            ->directory('brand/uploads')
                            ->disk('public')
                            ->visibility('public')
                            ->required(),

                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->maxLength(120),

                        Forms\Components\TextInput::make('alt')
                            ->label('Alt text')
                            ->maxLength(160),

                        Forms\Components\Textarea::make('caption')
                            ->label('Caption')
                            ->rows(2),
                    ])
                    ->action(function (array $data) {
                        $service = $this->getOwnerRecord();
                        $disk = 'public';
                        $storedPath = $data['file'];
                        $media = $service->addMediaFromDisk($storedPath, $disk)
                            ->usingName($data['name'] ?: pathinfo($storedPath, PATHINFO_FILENAME))
                            ->withCustomProperties([
                                'alt'     => $data['alt'] ?? null,
                                'caption' => $data['caption'] ?? null,
                            ])
                            ->toMediaCollection($data['collection_name']);

                        if ($data['collection_name'] === 'brand_cover') {
                            $service->media()
                                ->where('collection_name', 'brand_cover')
                                ->where('id', '!=', $media->id)
                                ->delete();
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column');
    }
}
