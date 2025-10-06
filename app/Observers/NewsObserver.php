<?php

namespace App\Observers;

use App\Models\News;

class NewsObserver
{
    /**
     * Handle the News "creating" event.
     */
    public function creating(News $news): void
    {
        if (blank($news->author_id) && auth()->check()) {
            $news->author_id = auth()->id();
        }
    }

    /**
     * Handle the News "updating" event.
     */
    public function updating(News $news): void
    {
        // optional: prevent changing author_id after creation
        if ($news->isDirty('author_id')) {
            $news->author_id = $news->getOriginal('author_id');
        }
    }
}
