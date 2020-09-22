@if ($posts->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($posts->onFirstPage())
            <li class="page-link disabled"><span>{{ __('Prev') }}</span></li>
        @else
            <li class="page-link"><a href="{{ $posts->previousPageUrl() }}" rel="prev">{{ __('Prev') }}</a></li>
        @endif

        {{ "Page " . $posts->currentPage() . "  of  " . $posts->lastPage() }}

        {{-- Next Page Link --}}
        @if ($posts->hasMorePages())
            <li class="page-link"><a href="{{ $posts->nextPageUrl() }}" rel="next">{{ __('Next') }}</a></li>
        @else
            <li class="page-link disabled"><span>{{ __('Next') }}</span></li>
        @endif
    </ul>
@endif

<style>
.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: space-evenly;
    align-items: center;
}
.paginator-results {
    margin-top: 15px;
}
</style>
