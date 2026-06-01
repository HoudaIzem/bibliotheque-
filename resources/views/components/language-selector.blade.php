<!-- Language Selector -->
<div class="relative inline-block group" id="language-selector">
    <button class="flex items-center text-gray-600 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium" id="language-button">
        <span> @if(app()->getLocale() === 'en') EN @else FR @endif</span>
    </button>

    <!-- Dropdown Menu -->
    <div class="absolute right-0 mt-0 w-32 bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all z-50 md:opacity-0 md:invisible md:group-hover:opacity-100 md:group-hover:visible" id="language-dropdown">
        <a href="{{ route('locale.change', 'en') }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-t-md @if(app()->getLocale() === 'en') bg-blue-50 text-blue-600 @endif">
            🇬🇧 English
        </a>
        <a href="{{ route('locale.change', 'fr') }}"
           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-b-md @if(app()->getLocale() === 'fr') bg-blue-50 text-blue-600 @endif">
            🇫🇷 Français
        </a>
    </div>
</div>

<script>
    // Mobile language selector toggle
    const languageButton = document.getElementById('language-button');
    const languageDropdown = document.getElementById('language-dropdown');

    if (languageButton && languageDropdown) {
        languageButton.addEventListener('click', function(e) {
            e.stopPropagation();
            if (window.innerWidth < 768) { // md breakpoint
                languageDropdown.classList.toggle('opacity-0');
                languageDropdown.classList.toggle('invisible');
                languageDropdown.classList.toggle('opacity-100');
                languageDropdown.classList.toggle('visible');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            if (window.innerWidth < 768) {
                languageDropdown.classList.add('opacity-0');
                languageDropdown.classList.add('invisible');
                languageDropdown.classList.remove('opacity-100');
                languageDropdown.classList.remove('visible');
            }
        });
    }
</script>
