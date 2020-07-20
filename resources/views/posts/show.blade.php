@extends('layouts.master')


    @section('content')

    @include('posts.article', ['type' => 'full'])
    <div class=" my-4">


    @can('update', $post)
    <form class="float-left" action="/posts/{{$post->id}}" method="POST" >
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" >DELETE</button>
        </form>
        <a class="ml-3" href="/posts/{{$post->slug}}/edit"><button class="btn btn-success">Edit</button></a>
    </div>

    @endcan
    @auth
    @include('comments.create')
    @endauth

    @include('comments.index')

    @endsection
