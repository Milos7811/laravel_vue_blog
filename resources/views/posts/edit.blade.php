@extends('layouts.master')
@section('content')

@include('error')
<form action="/posts/{{$post->slug}}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
@csrf
 <div class="form-group">
     <label for="title">Title</label>
 <textarea name="title" type="text" class="form-control" id="exampleFormControlTextarea1" rows="1">{{$post->title}}</textarea>
    <label for="exampleFormControlTextarea1">Post</label>
 <textarea name="text" type="text" class="form-control" id="exampleFormControlTextarea1" rows="10">{{$post->text}}</textarea>
<input type="hidden" name="post_id" value="{{$post->id}}">
</div>


<div class="images">

        @foreach ($post->images as $image)
        <form class="float-left" action="/posts/{{$post->id}}" method="POST" >
        <img src="{{$image->post_image_path}}" alt="" class="img-responsive"  width="200" height="200">
         <input class="form-check-input" type="checkbox" value="{{$image->id}}" id="tag" name="tags[]">

        @endforeach
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger" >DELETE</button>
        </form>

</div>

{{-- {{   dd($post->images)}} --}}

  <h6>Tags</h6>
            <div class="d-md-inline-flex border border-info">

                @foreach ($post->tags as $tag)
                <div class="form-check mr-2">
                 <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag" name="tags[]">
                 <label class="form-check-label" for="tag">
                         {{$tag->tag}}
                 </label>
                </div>
                 @endforeach
                </div>




        @csrf
        <div class="custom-file">
            <input type="file"  class="custom-file-input" name="images[]" id="inputFile"  aria-describedby="inputGroupFileAddon03" multiple>
            <label class="custom-file-label" for="inputFile">Choose file</label>
        </div>


<button type="submit" class="btn btn-primary">Submit</button>

<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
</form>
@endsection
