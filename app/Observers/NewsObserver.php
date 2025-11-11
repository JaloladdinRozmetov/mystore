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

    }

    /**
     * Handle the News "updating" event.
     */
    public function updating(News $news): void
    {
        // optional: prevent changing author_id after creation

    }
}
