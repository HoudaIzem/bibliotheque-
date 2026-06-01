<footer class="bg-white border-t border-gray-200 pb-2 pt-2">
    <div class="container mx-auto px-4 text-gray-500 text-center text-sm">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ __('about_us') }}</h4>
                <p class="mt-2 text-gray-500">{{ __('simple_library_template') }}</p>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ __('important_link') }}</h4>
                <ul class="mt-2 space-y-2">
                    <li><a href="{{ route('books') }}" class="text-gray-500 hover:text-gray-900">{{ __('search') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-500 hover:text-gray-900">{{ __('about') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-500 hover:text-gray-900">{{ __('contact') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ __('contact_info') }}</h4>
                <ul class="mt-2 space-y-2 text-gray-500">
                    <li>{{ __('email') }}: info@example.com</li>
                    <li>{{ __('phone') }}: +1 234 567 890</li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold text-gray-800">{{ __('newsletter') }}</h4>
                <form class="mt-2 flex">
                    <input type="email" placeholder="{{ __('your_email') }}" class="w-full px-3 py-2 rounded-l-md bg-gray-100 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="px-4 py-2 rounded-r-md bg-blue-600 hover:bg-blue-700 text-white font-semibold">{{ __('go') }}</button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-2 pb-2 mt-4 text-center text-sm text-gray-500">
            {{ __('copyright') }}
        </div>
    </div>
</footer>
