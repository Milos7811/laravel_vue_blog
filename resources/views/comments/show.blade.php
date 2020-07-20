<comment  :comment-data="{{$comment}}" inline-template>
    <div class="card" id="comments">
    <article class="card-body">
    <div class="card-text"
    ref="textArea"
    :contenteditable='contentEditabled'
    @keydown.enter="editComment"
    @keydown.esc="backText"
    @blur="backText"
    @input= "textChange" >
        {{$comment->text}}
    </div>
    <hr>
    <a class="text-dark" href="/users/{{$comment->user->id}}" class="author">
      <strong >  {{$comment->user->name}}</strong>
    </a>
    <br>
<time class="card-text text-muted" datetime="{{ $comment->created_at->toW3cString()}}">

            {{$comment->created_at->diffForHumans()}}
        </time>
        @can('update', $comment)
        <span class="float-right">
            <a class="btn btn-outline-primary"  @click="editMessage "
            @blur="editComment"
            >Edit</a>
            <a class="btn btn-outline-danger " @click="deleteComment"
            >Delete</a>
        </span>
        {{-- <span>
    <form action="/comments/{{$comment->id}}" method="POST" >
            @csrf
            @method('DELETE')
            <button >DELETE</button>

        </form>

    <form action="/comments/{{$comment->id}}" method="POST">
            @csrf
            @method('PATCH')
            <button>EDIT</button>
        </form>
</span> --}}
  @endcan

</article>
</div>
</comment>
