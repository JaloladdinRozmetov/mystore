<?php

namespace App\Filament\Resources\OurTeamResource\Pages;

use App\Filament\Resources\OurTeamResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Pages\EditRecord;

class ManageMedia extends EditRecord
{
    protected static string $resource = OurTeamResource::class;

    protected static ?string $title = 'Media';
    protected static ?string $breadcrumb = 'Media';


    protected function getFormSchema(): array
    {
        return [
            Section::make('Cover')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('team_cover')
                        ->collection('team_cover')
                        ->label('Cover')
                        ->image()
                        ->imageEditor()
                        ->imageEditorViewportWidth('1024')
                        ->imageEditorViewportHeight('576')
                        ->maxFiles(1)
                        ->maxSize(10048) // 2048 KB = 2 MB
                        ->deletable(true)
                        ->openable()
                        ->downloadable(),
                ])->columns(1),

            Section::make('Gallery')
                ->schema([
                    SpatieMediaLibraryFileUpload::make('team_gallery')
                        ->collection('team_gallery')
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
                ->url(fn () => OurTeamResource::getUrl('edit', ['record' => $this->record])),
        ];
    }
}
