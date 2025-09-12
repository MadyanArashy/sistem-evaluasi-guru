@if ($paginator->hasPages())
<nav class="pagination-nav" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
    <div class="pagination-wrapper">
        <div class="pagination-info">
            <p class="pagination-text">
                {!! __('Menampilkan') !!}
                @if ($paginator->firstItem())
                    <span class="pagination-number">{{ $paginator->firstItem() }}</span>
                    {!! __('sampai') !!}
                    <span class="pagination-number">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('dari') !!}
                <span class="pagination-number">{{ $paginator->total() }}</span>
                {!! __('hasil') !!}
            </p>
        </div>

        <div class="pagination-buttons">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-btn pagination-btn-disabled">
                    <i class="fas fa-chevron-left"></i>
                    <span class="sr-only">{{ __('Previous') }}</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn pagination-btn-active" rel="prev" aria-label="{{ __('Go to previous page') }}">
                    <i class="fas fa-chevron-left"></i>
                    <span class="sr-only">{{ __('Previous') }}</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-btn pagination-btn-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-btn pagination-btn-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-btn pagination-btn-active" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn pagination-btn-active" rel="next" aria-label="{{ __('Go to next page') }}">
                    <i class="fas fa-chevron-right"></i>
                    <span class="sr-only">{{ __('Next') }}</span>
                </a>
            @else
                <span class="pagination-btn pagination-btn-disabled">
                    <i class="fas fa-chevron-right"></i>
                    <span class="sr-only">{{ __('Next') }}</span>
                </span>
            @endif
        </div>
    </div>
</nav>
@endif
