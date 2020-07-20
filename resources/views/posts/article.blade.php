
<article class="card " {{$post->title}}>

<a  class="card-header text-secondary"  href="{{ route('posts.show', $post->slug)}}"> <h2 >{{$post->title}}</h2></a>
    <div class="card-body">
        <h4 class="card-text text-body">{!! nl2br($post->text)!!}</h4>


            <div>
                <image-galery :images="{{$post->images}}"/>
            </div>

        <br>
        <time class="card-text text-black-50 ">
            {{$post->created_at->diffForHumans()}}
        </time>
        <hr>
    <a class="float-right text-dark" href="/users/{{$post->user->id}}"> <h3>{{$post->user->name}}</h3>  <div class="user-link-picture my-2">
        <div class="user-image-wrapper">
            <img src="{{$post->user->avatar}}" alt="..." class="user-image">
        </div>

</div>
<footer class="commentNumber">
    <a class="text-muted " href="/posts/{{$post->slug}}#comments" > <p>{{$post->comments->count()}}</p>
        <strong >{{str_plural('comment',$post->comments->count() )}}</strong></a>
        <br>
        @include('partials.tags')

    </footer>
    </div>
</article>
