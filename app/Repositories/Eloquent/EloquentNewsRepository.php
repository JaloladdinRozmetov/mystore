<?php

namespace App\Repositories\Eloquent;

use App\Models\News;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
class EloquentNewsRepository
{
    public function paginatePublished(int $perPage = 12)
    {
        return News::published()->with('media')->latest('published_at')->paginate(perPage: $perPage);
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginateAll(int $perPage = 20): LengthAwarePaginator
    {
        return News::latest('created_at')->paginate($perPage);
    }

    /**
     * @param int $id
     * @return News|null
     */
    public function findById(int $id): ?News
    {
        return News::where('id',$id)->first();
    }
}
