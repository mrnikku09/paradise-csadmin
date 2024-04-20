<div class="d-flex justify-content-between align-items-center">
	@if(count($pagination)>0)
<div class="fs-7">Showing {{$pagination->firstItem()}} to {{$pagination->lastItem()}} of {{$pagination->total()}} entries</div>
@else
<div class="fs-7">Showing 0 to 0 of 0 entries</div>
@endif
	@if ($pagination->lastPage() > 1)
    <div class="pagination-wrap hstack gap-2">
		
        @if ($pagination->previousPageUrl())
            <a class="page-item pagination-prev" href="{{ $pagination->previousPageUrl() }}">
                Previous
            </a>
        @else
            <span class="page-item pagination-prev disabled">
                Previous
            </span>
        @endif
        
        <ul class="pagination listjs-pagination mb-0">
            {{ $pagination->links() }}
        </ul>
        @if ($pagination->nextPageUrl())
            <a class="page-item pagination-next" href="{{ $pagination->nextPageUrl() }}">
                Next
            </a>
        @else
            <span class="page-item pagination-next disabled">
                Next
            </span>
        @endif
    </div>
	@endif
</div>