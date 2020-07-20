@extends('layouts.master')




    @section('content')

    @auth

    <a href="/posts/create"> <button class="btn btn-primary"> New Post</button>  </a>
    @endauth
    <ul class="postsList container" >
        @foreach ($posts as $post)

        <li class='card mb-3'>
                @include('posts.article', ['type' => 'listing'])
        </li>

        @endforeach
    </ul>
    <div class="d-flex justify-content-center">


        {{ $posts->render() }}
    </div>

    @endsection


