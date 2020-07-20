<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\User;
use App\PostImage;
use App\Http\Controllers\PostImageController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('posts.index', [

            'posts' =>  Post::with('comments', 'user', 'images', 'tags')->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $tags = Tag::get()->all();
        return view('posts.create', [
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request, Post $post)
    {


        $request->slug = str_slug($request->title);
        $tags = $request->tags;

        $request->validate(
            [
                'title' => 'required|unique:posts',
                'text' => 'required',
                'user_id' => 'required|integer|exists:users,id',
                'images.*' => 'image|mimes:image,jpeg,png,jpg,gif,svg|max:30000',
            ],
        );


        $post =  [
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text,
            'user_id' => $request->user_id,

        ];



        $newPost = Post::create($post);
        if ($tags) {
            $newPost->tags()->attach($tags);
        }


        $newPostId = Post::get()->where('slug', '=', $request->slug)->first()->getOriginal('id');


        if ($request->files) {
            PostImageController::store($newPostId, $request->file('images'));
        };
        return  redirect('/posts')->with('flash', 'Add post successful!');
    }

    // public function uploadImage($post, $images)
    // {
    //     if ($images) {


    //         foreach ($images as $image) {

    //             $imageName =  $post . '_image' . time() . '.' . $image->getClientOriginalName();
    //             $imagePath = "images/post-$post";
    //             $image->storeAs("$imagePath", $imageName);

    //             $newImage = [
    //                 'post_id' => $post,
    //                 'post_image_path' => '/storage/' . $imagePath . '/' . $imageName,
    //                 'post_image_caption' => $imageName,
    //             ];

    //             PostImage::create($newImage);
    //         };
    //     }


    //     return back();
    // }

    /**
     * Display the specified resource.
     *
     */
    public function show(Post $post)
    {


        $post->with(['comments', 'comments.user', 'tags'])->paginate(10);
        return view('posts.show', [
            'post' => $post

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id === $post->user_id) {

            $post->with(['tags', 'images']);
            return view('posts.edit', [
                'post' => $post
            ]);
        } else {
            return redirect('/posts');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request);
        $request->slug = str_slug($request->title);

        $request->validate([
            'title' => "required|unique:posts,slug,{$request->post_id}",
            // 'slug' => "unique:posts,slug,{$request->post_id}",
            'text' => 'required',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $newpost =  [
            'title' => $request->title,
            'slug' => $request->slug,
            'text' => $request->text,
            'user_id' => $request->user_id,
        ];

        $post = Post::findOrFail($request->post_id);
        $post->update(
            $newpost
        );

        return redirect("/posts/{$request->slug}");
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id, Request $request)
    {
        dd($request);
        $post = Post::findOrFail($id);

        if ($post->images) {
            Storage::deleteDirectory('images/post-' . $post->id);
        }

        $post->delete();



        return redirect('/posts');
    }
}
