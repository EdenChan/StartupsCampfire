<div class="well">
    <h4>热门活动</h4>

    <div class="row">
        <ul>
        @foreach($hot_events as $hot_event)
            <li>
                <a href="{{ route('frontend::events.show', ['id' => $hot_event->id]) }}">{{ $hot_event->title }}</a>
            </li>
        @endforeach
        </ul>
    </div>
</div>