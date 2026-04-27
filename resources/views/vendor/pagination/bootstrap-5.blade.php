@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="d-flex justify-content-center">
        <ul class="pagination pagination-sm pagination-responsive" style="gap: 0.25rem; margin: 1rem 0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link"><i class="bi bi-chevron-left d-md-none"></i><span class="d-none d-md-inline">@lang('pagination.previous')</span></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="bi bi-chevron-left d-md-none"></i><span class="d-none d-md-inline">@lang('pagination.previous')</span></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page" aria-label="@lang('pagination.page', ['page' => $page])">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            @if ($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() + 1 || $page == 1 || $page == $paginator->lastPage() || $page == $paginator->currentPage())
                                <li class="page-item d-none d-sm-inline-flex">
                                    <a class="page-link" href="{{ $url }}" aria-label="@lang('pagination.go_to_page', ['page' => $page])">{{ $page }}</a>
                                </li>
                            @elseif ($page == $paginator->currentPage() - 2 || $page == $paginator->currentPage() + 2)
                                <li class="page-item d-none d-md-inline-flex">
                                    <a class="page-link" href="{{ $url }}" aria-label="@lang('pagination.go_to_page', ['page' => $page])">{{ $page }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="bi bi-chevron-right d-md-none"></i><span class="d-none d-md-inline">@lang('pagination.next')</span></a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link"><i class="bi bi-chevron-right d-md-none"></i><span class="d-none d-md-inline">@lang('pagination.next')</span></span>
                </li>
            @endif
        </ul>
    </nav>
@endif
