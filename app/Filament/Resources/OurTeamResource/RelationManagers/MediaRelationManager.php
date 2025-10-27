<?php

namespace App\Filament\Resources\OurTeamResource\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    protected static ?string $title = 'Media';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')->label('Name')->required(),
            Textarea::make('custom_properties.caption')->label('Caption'),
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
                                'team_cover'   => 'Cover (single)',
                                'team_gallery' => 'Gallery',
                            ])
                            ->default('team_gallery')
                            ->required(),


                        FileUpload::make('file')
                            ->label('Image')
                            ->image()
                            ->directory('team/uploads')
                            ->disk('public')
                            ->visibility('public')
                            ->required(),

                        TextInput::make('name')
                            ->label('Name')
                            ->maxLength(120),

                        TextInput::make('alt')
                            ->label('Alt text')
                            ->maxLength(160),

                        Textarea::make('caption')
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

                        if ($data['collection_name'] === 'team_cover') {
                            $service->media()
                                ->where('collection_name', 'team_cover')
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
