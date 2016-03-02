@if ($paginator->lastPage() > 1)
    <div class="am-fr">
    <ul  class="am-pagination">
        <li class="{{ ($paginator->currentPage() == 1) ? 'am-disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}"><<</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? 'am-active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'am-disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >>></a>
        </li>
    </ul>
    </div>
@endif