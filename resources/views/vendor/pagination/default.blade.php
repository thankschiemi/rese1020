@if ($paginator->hasPages())
<nav class="pagination-container">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="pagination-item disabled" aria-disabled="true">
            <span>‹</span>
        </li>
        @else
        <li class="pagination-item">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">‹</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="pagination-item disabled" aria-disabled="true">
            <span>{{ $element }}</span>
        </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="pagination-item active" aria-current="page">
            <span>{{ $page }}</span>
        </li>
        @else
        <li class="pagination-item">
            <a href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="pagination-item">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">›</a>
        </li>
        @else
        <li class="pagination-item disabled" aria-disabled="true">
            <span>›</span>
        </li>
        @endif
    </ul>
</nav>
@endif