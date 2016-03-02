<ul class="pull-right list-inline remove-margin-bottom">
    <li>
        <a href="{{ route($filter_url_segment).'?filter=recent' }}">
            <i class="fa fa-clock-o"></i> 发表时间
        </a>
        <span class="divider"></span>
    </li>
    <li>
        <a href="{{ route($filter_url_segment).'?filter=vote' }}">
            <i class="fa fa-thumbs-up"> </i> 广受赞同
        </a>
        <span class="divider"></span>
    </li>
    <li>
        <a href="{{ route($filter_url_segment).'?filter=comment' }}">
            <i class="fa fa-comment"></i> 热点关注
        </a>
    </li>
    <li>
        <a href="{{ route($filter_url_segment).'?filter=nocomment' }}">
            <i class="fa fa-eye"></i> 人气寥寥
        </a>
    </li>
</ul>