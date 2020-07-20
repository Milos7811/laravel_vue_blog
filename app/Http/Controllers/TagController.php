<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class TagController extends Controller
{
    public function show($id)
    {
        // dd($id);
        $tag = Tag::findorFail($id);
        $posts = $tag->posts;

        $data = $this->paginate($posts);


        return view('posts.index', [
            // 'title' => $tag->tag,
            'paginate',
            'posts' => $data

        ]);
    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $pageName = 'page';
        $page     = $page ?: (Paginator::resolveCurrentPage($pageName) ?: 1);
        $items    = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            [
                'path'     => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );
    }
}
