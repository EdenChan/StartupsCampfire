<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title text-center">分类导航</h3>
        </div>
        <div class="panel-body">
            <dl class="dl-horizontal">
                @foreach($display_category_tree as $category_level_1)
                <dt>{{ $category_level_1->content }}</dt>
                <dd>
                    <ul class="list-inline">
                        @foreach($category_level_1['children'] as $category_level_2)
                        <li>
                            <a href="{{ route('frontend::categories.show', ['url_tag' => $category_level_2->url_tag]) }}">{{ $category_level_2->content }}({{ $category_level_2->content_count }})</a>
                        </li>
                        @endforeach
                    </ul>
                </dd>
                @endforeach
            </dl>
        </div>
    </div>
</div>