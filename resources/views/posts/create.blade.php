

@extends('layouts.master')
@section('content')

@include('error')
<form action="/posts" method="POST" enctype="multipart/form-data">
@csrf
    <div class="form-group">
         <label for="title">Title</label>
            <textarea name="title" type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Title"></textarea>
        <label for="exampleFormControlTextarea1">Post</label>
            <textarea name="text" type="text" class="form-control" id="exampleFormControlTextarea1" rows="10" placeholder="Text"></textarea>

            <h6>Tags</h6>
            <div class="d-md-inline-flex border border-info">

                @foreach ($tags as $tag)
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

    </div>
    <div class="btn-group float-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    {{-- </form> --}}
        <a class="float-right mt-4" href="{{ URL::previous() }}" >Cancel</a>
    </div>

    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

</form>

@endsection
