@extends('layouts.master')

@section('content')
@include('error')

<a href="/password/reset" class="card-link tex-center">Reset password</a>
    <div class="card position-center" style="width: 25rem;">
    <form action="/avatar" method="POST" enctype="multipart/form-data" class="input-group mb-3">
    @csrf
        <div class="input-group-prepend">
            <button type="submit" class="input-group-text">Upload photo</button>
        </div>

        <div class="custom-file">
            <input type="file"  class="custom-file-input" name="avatar" id="avatarFile" aria-describedby="fileHelp">
            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
        </div>

    </form>


<form >
<img src="{{asset("$user->avatar")}}" class="card-img-top" alt="avatar">

<div class="card-body">
    <h5 class="card-title h2"> {{$user->name}}</h5>

    <form class="list-group list-group-flush" tag="ul" action="/users/{{$user->id}}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input class="list-group-item" tag="li" name="name"  cols="30" rows="1" value="{{$user->name}}" >
        <label for="email">Email</label>
        <input class="list-group-item" tag="li" name="email"  cols="30" rows="1" value="{{$user->email}}" >
        {{-- <label for="tel-number">Picture</label>
        <input class="list-group-item" tag="li" name="picture"  cols="30" rows="1" type="file" > --}}
    </form>


    <div class="card-body text-center">
        <button type="submit"  class="card-link btn btn-outline-info ">Save</button>
    <a href="{{ URL::previous() }}" class="card-link btn btn-outline-info ">Cancel</a> <br>
    </div>


</div>
</div>
</div>

@endsection
