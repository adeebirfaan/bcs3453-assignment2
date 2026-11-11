{{-- Compact pagination: ‹ 1 … 4 5 6 … 10 ›  (first, last, and one page either side of the current one) --}}
@php
    $current = $paginator->currentPage();
    $last    = $paginator->lastPage();

    // Page numbers to show; null means "…"
    $pages = [];
    foreach (range(1, $last) as $page) {
        if ($page === 1 || $page === $last || abs($page - $current) <= 1) {
            $pages[] = $page;
        } elseif (end($pages) !== null) {
            $pages[] = null;
        }
    }
@endphp

<nav class="pager" aria-label="Pagination">
    <p class="pager__info">
        Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
    </p>

    @if ($paginator->hasPages())
        <ul class="pager__group">
            <li>
                @if ($paginator->onFirstPage())
                    <span class="pager__link" aria-disabled="true" aria-label="Previous page">‹</span>
                @else
                    <a class="pager__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">‹</a>
                @endif
            </li>

            @foreach ($pages as $page)
                <li class="pager__num">
                    @if ($page === null)
                        <span class="pager__link pager__gap" aria-hidden="true">…</span>
                    @elseif ($page === $current)
                        <span class="pager__link" aria-current="page">{{ $page }}</span>
                    @else
                        <a class="pager__link" href="{{ $paginator->url($page) }}" aria-label="Page {{ $page }}">{{ $page }}</a>
                    @endif
                </li>
            @endforeach

            <li>
                @if ($paginator->hasMorePages())
                    <a class="pager__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">›</a>
                @else
                    <span class="pager__link" aria-disabled="true" aria-label="Next page">›</span>
                @endif
            </li>
        </ul>
    @endif
</nav>
