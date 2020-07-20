@include('error')

<div class="my-5">
 <form class="group mt-20" action="/comments" method="POST">
    @csrf
 <div class="form-group">
    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-success" >Add comment</button>
<input type="hidden" name="post_id" value="{{$post->id}}">

</form>
</div>
<hr>
