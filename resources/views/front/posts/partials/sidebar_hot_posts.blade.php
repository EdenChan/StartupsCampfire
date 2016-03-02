<div class="well">
    <h4>热门话题</h4>
    <div class="row">
        <ul>
        @foreach($hot_posts as $hot_post)
            <li>
                <a href="{{ route('frontend::posts.show', ['id' => $hot_post->id]) }}">{{ $hot_post->title }}</a>
            </li>
        @endforeach
        </ul>
    </div>
</div>