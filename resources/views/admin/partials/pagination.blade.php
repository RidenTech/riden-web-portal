@php
    $current = max(1, (int) ($current ?? 1));
    $last = max($current, (int) ($last ?? 5));

    $pages = [];
    for ($i = 1; $i <= $last; $i++) {
        $pages[] = $i;
    }
@endphp

<nav class="riden-pagination" aria-label="Pagination">
    <a class="riden-pagination__btn" href="#" aria-label="Previous page">
        <i class="bi bi-chevron-left"></i>
    </a>

    @foreach ($pages as $p)
        <a class="riden-pagination__page {{ $p === $current ? 'is-active' : '' }}" href="#">
            {{ $p }}
        </a>
    @endforeach

    <span class="riden-pagination__dots">…</span>

    <a class="riden-pagination__page" href="#">5</a>

    <a class="riden-pagination__btn is-primary" href="#" aria-label="Next page">
        <i class="bi bi-chevron-right"></i>
    </a>
</nav>

