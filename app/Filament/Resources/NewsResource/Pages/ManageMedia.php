<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class ManageMedia extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected static ?string $title = 'Media';
    protected static ?string $breadcrumb = 'Media';


    protected function getFormSchema(): array
    {
        return [
            Section::make('Cover')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('news_cover')
                        ->collection('news_cover')
                        ->label('Cover')
                        ->image()
                        ->imageEditor()
                        ->imageEditorViewportWidth('1024')
                        ->imageEditorViewportHeight('576')
                        ->maxFiles(1)
                        ->deletable(true)
                        ->openable()
                        ->downloadable(),
                ])->columns(1),

            Section::make('Gallery')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('news_gallery')
                        ->collection('news_gallery')
                        ->label('Gallery')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->panelLayout('grid')
                        ->deletable(true)
                        ->openable()
                        ->downloadable(),
                ])->columns(1),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view')
                ->label('Back to details')
                ->url(fn () => NewsResource::getUrl('edit', ['record' => $this->record])),
        ];
    }
}
