<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ManageMedia extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected static ?string $navigationLabel = 'Media';
    protected static ?string $title = 'Media';


    protected function getFormSchema(): array
    {
        return [
            Tabs::make('MediaTabs')->tabs([
                Tabs\Tab::make('Cover')->schema([
                    Section::make()
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('service_cover')
                                ->collection('service_cover')
                                ->label('Cover')
                                ->image()
                                ->imageEditor()
                                ->maxFiles(1)
                                ->deletable(true)
                                ->openable()
                                ->downloadable(),
                        ]),
                ]),

                Tabs\Tab::make('Gallery')->schema([
                    Section::make()
                        ->schema([
                            SpatieMediaLibraryFileUpload::make('service_gallery')
                                ->collection('service_gallery')
                                ->label('Gallery')
                                ->image()
                                ->multiple()
                                ->reorderable()
                                ->panelLayout('grid')
                                ->deletable(true)
                                ->openable()
                                ->downloadable(),
                        ]),
                ]),
            ])->columnSpanFull(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view')
                ->label('Back to details')
                ->url(fn () => ServiceResource::getUrl('edit', ['record' => $this->record])),
        ];
    }
}
