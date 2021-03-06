@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <input type="button" disabled value="前の{{LIMIT_PAGE}}件を表示" class="btn btn-primary btn-sm">
        @else
            <input type="button" onClick="location.href='{{ $paginator->previousPageUrl() }}'"  rel="prev" value="前の{{LIMIT_PAGE}}件を表示" class="btn btn-primary btn-sm">
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <input type="button" onClick="location.href='{{ $paginator->nextPageUrl() }}'" rel="next" value="次の{{LIMIT_PAGE}}件を表示" class="btn btn-primary btn-sm" >
        @else
            <input type="button" disabled value="次の{{LIMIT_PAGE}}件を表示" class="btn btn-primary btn-sm">
        @endif
    </ul>
@endif

