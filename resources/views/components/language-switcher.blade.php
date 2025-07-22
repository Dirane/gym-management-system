@props(['class' => '', 'mobile' => false])

@php
    $currentLocale = session('locale', 'en');
    $languages = [
        'en' => [
            'name' => 'English',
            'code' => 'EN',
            'flag' => '🇺🇸'
        ],
        'fr' => [
            'name' => 'Français',
            'code' => 'FR',
            'flag' => '🇫🇷'
        ]
    ];
@endphp

@if($mobile)
    <!-- Mobile Language Switcher -->
    <div class="px-3 py-2 border-t border-gray-200">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700">{{__('messages.language')}}</span>
            <div class="flex items-center space-x-2">
                @foreach($languages as $locale => $lang)
                    <a href="{{ route('language.switch', $locale) }}" 
                       class="flex items-center px-3 py-2 rounded-lg transition-colors duration-200 {{ $currentLocale === $locale ? 'bg-blue-600 text-white' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        <span class="text-sm mr-1">{{ $lang['flag'] }}</span>
                        <span class="text-sm font-medium">{{ $lang['code'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@else
    <!-- Desktop Language Switcher -->
    <div x-data="{ open: false }" class="relative {{ $class }}">
        <button @click="open = !open" 
                class="group bg-white hover:bg-gray-50 text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-blue-600/20 border border-gray-200">
            <div class="flex items-center space-x-2">
                <span class="text-lg">{{ $languages[$currentLocale]['flag'] }}</span>
                <span class="text-sm font-semibold">{{ $languages[$currentLocale]['code'] }}</span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </button>

        <!-- Dropdown Menu -->
        <div x-cloak x-show="open" 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
             x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="transform opacity-0 scale-95 translate-y-2"
             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-200 py-2 z-[9999] backdrop-blur-sm">
            @foreach($languages as $locale => $lang)
                <a href="{{ route('language.switch', $locale) }}" 
                   class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-all duration-200 first:rounded-t-xl last:rounded-b-xl {{ $currentLocale === $locale ? 'bg-blue-600/10 text-blue-600 font-semibold' : '' }}">
                    <span class="text-lg mr-3">{{ $lang['flag'] }}</span>
                    <span class="font-medium">{{ $lang['name'] }}</span>
                    @if($currentLocale === $locale)
                        <svg class="w-4 h-4 ml-auto text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endif 