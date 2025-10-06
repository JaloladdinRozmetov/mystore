<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\EloquentNewsRepository;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @param EloquentNewsRepository $repo
     */
    public function __construct(
        private EloquentNewsRepository $repo,
    ) {}

    public function index()
    {
        $news = $this->repo->paginatePublished(12);
        return view('new.news', compact('news'));
    }

    /**
     * @return View
     */
    public function show(string $locale,int $id): View
    {
        $item = $this->repo->findById($id);
        abort_if(!$item || $item->status !== 'published', 404);
        return view('new.news-detail', compact('item'));
    }
}
