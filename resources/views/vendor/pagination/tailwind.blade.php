@if ($paginator->hasPages())
    <nav class="flex justify-center mt-8">
        <ul class="inline-flex items-center space-x-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-gray-400 bg-white border rounded-l">
                    ‹
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-2 bg-white border rounded-l hover:bg-gray-100">
                        ‹
                    </a>
                </li>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="px-3 py-2 bg-white border text-gray-500">
                        {{ $element }}
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 bg-blue-600 text-white border">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-2 bg-white border hover:bg-gray-100">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-2 bg-white border rounded-r hover:bg-gray-100">
                        ›
                    </a>
                </li>
            @else
                <li class="px-3 py-2 text-gray-400 bg-white border rounded-r">
                    ›
                </li>
            @endif

        </ul>
    </nav>
@endif
