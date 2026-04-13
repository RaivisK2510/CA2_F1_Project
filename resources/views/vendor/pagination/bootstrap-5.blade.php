@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="d-flex justify-content-center">
        <ul class="pagination pagination-sm" style="gap: 0.25rem; margin: 1rem 0;">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">@lang('pagination.previous')</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">@lang('pagination.previous')</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page" aria-label="@lang('pagination.page', ['page' => $page])">
                                <span class="page-link" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}" aria-label="@lang('pagination.go_to_page', ['page' => $page])" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">@lang('pagination.next')</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" style="padding: 0.25rem 0.5rem; font-size: 0.875rem;">@lang('pagination.next')</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
