<?php

namespace App\Http\Controllers\API;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        return Tag::get()->all();
    }

    public function store(Request $request)
    {
        $request->validate([

            'tag' => 'required|unique:tags',

        ]);

        $tag = Tag::create($request->all());

        return response()->json([
            'message' => 'mas to vytvorene',
            'post' => $tag,
        ], 201);
    }
    public function update(Request $request, Tag $tag)
    {
        $request->validate([

            'tag' => 'required|unique:tags',

        ]);

        $tag->tag = $request->tag;
        $tag->save();
    }
    public function destroy(Tag $tag)
    {

        $tag->delete();

        return response()->json([
            'message' => 'tag deleted'
        ], 200);
    }
}
