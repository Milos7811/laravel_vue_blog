<?php

namespace App\Http\Controllers;

use App\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostImageController extends Controller
{
    public static function store($post, $images)
    {
        if ($images) {


            foreach ($images as $image) {

                $imageName =  $post . '_image' . time() . '.' . $image->getClientOriginalName();
                $imagePath = "images/post-$post";
                $image->storeAs("$imagePath", $imageName);

                $newImage = [
                    'post_id' => $post,
                    'post_image_path' => '/storage/' . $imagePath . '/' . $imageName,
                    'post_image_caption' => $imageName,
                ];

                PostImage::create($newImage);
            };
        }


        return back();
    }


    public function destroy(Request $request)
    {
        $post = PostImage::findOrFail($request->image->id);

        if ($post->images) {
            Storage::deleteDirectory('images/post-' . $post->id);
        }

        $post->delete();



        return redirect('/posts');
    }
}
