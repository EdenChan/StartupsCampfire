<div class="well">
    <h4>站点公告</h4>
        <div class="row">
            @if (count($online_notices) > 0)
                <ul>
                @foreach($online_notices as $online_notice)
                    <li>
                        <a href="{{ route('frontend::notices.show', ['notice_id' => $online_notice->id]) }}">{{ $online_notice->title }}</a>
                    </li>
                @endforeach
                </ul>
            @else
                暂无站点公告~
            @endif
        </div>
    </div>
</div>