<nav aria-label="Page navigation">
    <ul class="pagination pagination-rounded">
        @if ($cities->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $cities->previousPageUrl() }}">Previous</a>
            </li>
        @endif

        @if ($currentPage > 1 && $currentPage > 6)
            <li class="page-item">
                <a class="page-link" href="{{ $cities->url(1) }}">1</a>
            </li>
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
        @endif

        @foreach ($pageRange as $page)
            <li class="page-item {{ $currentPage == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $cities->url($page) }}">{{ $page }}</a>
            </li>
        @endforeach

        @if ($currentPage < $totalPages - 5 && $currentPage < $totalPages - 1)
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="{{ $cities->url($totalPages) }}">{{ $totalPages }}</a>
            </li>
        @endif

        @if ($cities->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $cities->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</nav>
