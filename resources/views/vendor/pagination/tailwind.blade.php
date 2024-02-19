@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        {{-- Botón de "Anterior" --}}
        <div class="flex justify-start flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-black border border-marvel-red cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-black border border-marvel-red leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif
        </div>

        {{-- Información de la página --}}
        <div class="hidden sm:flex sm:items-center sm:justify-between flex-1">
            <div class="text-center">
                <p class="text-sm text-white leading-5">
                    {!! __('Mostrando') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('a') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('resultados') !!}
                </p>
            </div>
        </div>

        {{-- Botones de navegación --}}
        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Botón de "Anterior" --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true">
                        <span class="relative inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-black border border-marvel-red cursor-default rounded-l-md leading-5" aria-hidden="true">
                            {!! __('pagination.previous') !!}
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-1 text-sm font-medium text-white bg-black border border-marvel-red rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                        {!! __('pagination.previous') !!}
                    </a>
                @endif

                {{-- Elementos de paginación --}}
                <div class="flex items-center">
                    @foreach ($elements as $element)
                        {{-- Arreglo de enlaces --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-1 -ml-px text-sm font-medium text-white bg-black border border-marvel-red cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-1 -ml-px text-sm font-medium text-white bg-black border border-marvel-red leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>

                {{-- Botón de "Siguiente" --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-1 -ml-px text-sm font-medium text-white bg-black border border-marvel-red rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                        {!! __('pagination.next') !!}
                    </a>
                @else
                    <span aria-disabled="true">
                        <span class="relative inline-flex items-center px-2 py-1 -ml-px text-sm font-medium text-white bg-black border border-marvel-red cursor-default rounded-r-md leading-5" aria-hidden="true">
                            {!! __('pagination.next') !!}
                        </span>
                    </span>
                @endif
            </span>
        </div>
    </nav>
@endif
