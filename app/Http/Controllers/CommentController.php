<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'post_id' => 'required|integer|exists:posts,id'
        ]);
        $comment =  auth()->user()->comments()->create($request->all());




        return redirect('/posts/' . $comment->post->slug . '#comments')
            ->with('flash', 'Add comment successful!');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->text = $request->text;
        $comment->save();
    }

    public function destroy(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        // return redirect('/posts/' . $comment->post_id . '#comments')->with('flash', 'Comment deleted ! ');
    }
}
