<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function home()
    {

        // return User::first()->posts;

        // return \DB::table('posts')->get();

        // return view('welcome', [
        //     'title' => 'Welcome on the website',
        //     'posts' =>  Post::all()
        // ]);
    }

    public function contact()
    {
        return 'contact page';
    }

    public function about()
    {
        return view('about');
    }
}
