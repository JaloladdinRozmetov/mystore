<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // slug from UZ title if empty
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title_uz'] ?? 'news');
        }

        // publish time
        $data['published_at'] = ($data['status'] ?? 'draft') === 'published'
            ? ($data['published_at'] ?? now())
            : null;

        return $data;
    }
}
