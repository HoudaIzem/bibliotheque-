<header class="bg-white border-b border-gray-200 shadow-sm">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('index') }}" class="text-gray-800 font-bold text-xl">{{ __('online_library') }}</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('index') }}"
                            class="text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">{{ __('home') }}</a>
                        <a href="{{ route('book.index') }}"
                            class="text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">{{ __('books') }}</a>
                        <a href="{{ route('books') }}"
                            class="text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">{{ __('search') }}</a>
                        <a href="{{ route('about') }}"
                            class="text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">{{ __('about') }}</a>
                        <a href="{{ route('contact') }}"
                            class="text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">{{ __('contact') }}</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="flex items-center space-x-3">
                    @include('components.language-selector')

                    @auth
                        @include('layouts.navigation')
                    @else
                        <div class="ml-4 flex items-center md:ml-6">
                            <a href="{{ route('login') }}"
                                class="text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">
                                {{ __('login') }}
                            </a>

                            <a href="{{ route('register') }}"
                                class="ml-4 text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium">
                                {{ __('register') }}
                            </a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button" class="text-gray-600 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <a href="{{ route('index') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('home') }}</a>
                <a href="{{ route('book.index') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('books') }}</a>
                <a href="{{ route('books') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('search') }}</a>
                <a href="{{ route('about') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('about') }}</a>
                <a href="{{ route('contact') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('contact') }}</a>

                <div class="border-t border-gray-200 pt-4 pb-3">
                    <div class="flex items-center px-5">
                        @include('components.language-selector')
                    </div>
                    @auth
                        @include('layouts.navigation')
                    @else
                        <div class="mt-3 space-y-1 px-2">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('login') }}</a>
                            <a href="{{ route('register') }}" class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">{{ __('register') }}</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
