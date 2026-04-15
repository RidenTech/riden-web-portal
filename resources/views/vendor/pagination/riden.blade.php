@if ($paginator->hasPages())
    <div class="booking-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pg-link disabled"><i class="bi bi-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pg-link"><i class="bi bi-chevron-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pg-dots">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pg-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pg-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pg-link nav-btn"><i class="bi bi-chevron-right"></i></a>
        @else
            <span class="pg-link nav-btn disabled"><i class="bi bi-chevron-right"></i></span>
        @endif
    </div>
@endif
