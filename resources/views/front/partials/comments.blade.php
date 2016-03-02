<hr>
<div>
    <strong>评论 <small>共{{ $commentable_model->comments->count() }}条</small></strong>
</div>
<br>
@if(count($commentable_model->comments) > 0)
    @foreach($commentable_model->comments()->get() as $comment)
    <div class="media comment-box" id="scamp_comment_{{ $comment->id }}">
        <a class="pull-left" href="{{ route('frontend::user.profile', ['user_id' => $comment->user->id]) }}">
            <img class="media-object img-circle" width="60" height="60" src="{{ $comment->user->profile->avatar_full_path }}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><a class="author_name" href="{{ route('frontend::user.profile', ['user_id' => $comment->user->id]) }}">{{ $comment->user->name }}</a>
                <small>{{ $comment->created_at }}</small>
            </h4>
            {!! $comment->body_parsed !!}
            <p>
                <a href="javascript:void(0)" onclick="replyOn('{{$comment->user->name }}')"><i class="fa fa-reply"></i></a> •
                <a href="{{ route('frontend::comments.upvote', ['comment_id' => $comment->id]) }}"><i class="fa fa-thumbs-up"></i></a>{{ '('.$comment->vote_count.')'}}
                •
                <a href="{{ route('frontend::comments.downvote', ['comment_id' => $comment->id]) }}"><i class="fa fa-thumbs-down"></i></a>
                @if($comment->user->is_auth)
                • <a href="javascript:void(0)">
                    <i class="fa fa-trash-o" onclick="deleteResource({{ $comment->id }}, 'comment')"></i>
                </a>
                <form id="delete_comment_{{ $comment->id }}" action="{{ route('frontend::comments.destroy', ['id' => $comment->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
                @endif
            </p>
        </div>
    </div>
    @endforeach
@endif
<br>
@include('front.partials.errors')
<div class="well well-sm clearfix">
    <form id="commentform" class="form-vertical" action="{{ route('frontend::comments.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="col-xs-12">
                <input type="hidden" name="commentable_id" value="{{ $commentable_model->id }}"/>
                <input type="hidden" name="commentable_type" value="{{ get_class($commentable_model) }}"/>
                <textarea id="comment-body" name="body" class="form-control comment-box"
                          @if(!Auth::id('user'))
                          placeholder="登陆后才可评论" disabled="disabled"
                          @else
                          placeholder="输入你的评论"
                          @endif
                           rows="3"></textarea>
                <br>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 comment-button">
                <button @if(!Auth::id('user'))
                        disabled="disabled"
                        @endif
                        id="contact-submit" type="submit" class="btn btn-primary"><i class="fa fa-comment"></i> 发表</button> <label id="commentstatus"></label>
            </div>
        </div>
    </form>
</div>