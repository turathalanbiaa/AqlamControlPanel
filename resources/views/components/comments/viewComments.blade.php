




<div class="col-lg-8 pb-5">
    <h3 class="text-center mt-5">التعليقات</h3>
    @foreach($comments as $comment)
        <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body mr-2 pt-2">
                <button type="button" data-id="{{$comment->id}}"  class="close float-left "  data-toggle="modal"
                        data-target="#deleteComment" aria-label="Close">
                    <span aria-hidden="true" style="color: red">&times;</span>
                </button>
                <h5 class="mt-0 mr-2"><a href="#">{{$comment->user->name}}</a></h5>
                <p class="mr-2">{{$comment->content}}</p>
                <time>{{$comment->created_at}}</time>
            </div>
        </div>
    @endforeach
</div>