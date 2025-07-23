@props(['mobile' => false])

<div class="relative" x-data="{ open: false }" @click.away="open = false">
    @if($mobile)
        <!-- Mobile Language Switcher -->
        <div class="w-full">
            <h4 class="text-sm font-medium text-gray-700 mb-3">{{ __('messages.language') }}</h4>
            <button @click="open = !open" 
                    class="w-full flex items-center justify-between px-3 py-3 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors touch-target">
                <div class="flex items-center">
                    @if(app()->getLocale() === 'fr')
                        <span class="text-lg mr-2">🇫🇷</span>
                        <span class="text-sm font-medium">Français</span>
                    @else
                        <span class="text-lg mr-2">🇺🇸</span>
                        <span class="text-sm font-medium">English</span>
                    @endif
                </div>
                <svg class="w-4 h-4 text-gray-500 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            
            <div x-show="open" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
                <div class="py-2">
                    <a href="{{ route('language.switch', 'en') }}" 
                       class="flex items-center px-3 py-3 hover:bg-gray-50 transition-colors touch-target {{ app()->getLocale() === 'en' ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}"
                       @click="open = false">
                        <span class="text-lg mr-3">🇺🇸</span>
                        <span class="text-sm font-medium">English</span>
                        @if(app()->getLocale() === 'en')
                            <svg class="w-4 h-4 ml-auto text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </a>
                    <a href="{{ route('language.switch', 'fr') }}" 
                       class="flex items-center px-3 py-3 hover:bg-gray-50 transition-colors touch-target {{ app()->getLocale() === 'fr' ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}"
                       @click="open = false">
                        <span class="text-lg mr-3">🇫🇷</span>
                        <span class="text-sm font-medium">Français</span>
                        @if(app()->getLocale() === 'fr')
                            <svg class="w-4 h-4 ml-auto text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Desktop Language Switcher -->
        <button @click="open = !open" 
                class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 rounded-md transition-colors touch-target">
            @if(app()->getLocale() === 'fr')
                <span class="text-base mr-2">🇫🇷</span>
                <span class="hidden sm:inline">FR</span>
            @else
                <span class="text-base mr-2">🇺🇸</span>
                <span class="hidden sm:inline">EN</span>
            @endif
            <svg class="w-3 h-3 ml-1 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute right-0 top-full mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
            <div class="py-2">
                <a href="{{ route('language.switch', 'en') }}" 
                   class="flex items-center px-3 py-2 text-sm hover:bg-gray-50 transition-colors touch-target {{ app()->getLocale() === 'en' ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}"
                   @click="open = false">
                    <span class="text-base mr-2">🇺🇸</span>
                    <span class="font-medium">English</span>
                    @if(app()->getLocale() === 'en')
                        <svg class="w-3 h-3 ml-auto text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    @endif
                </a>
                <a href="{{ route('language.switch', 'fr') }}" 
                   class="flex items-center px-3 py-2 text-sm hover:bg-gray-50 transition-colors touch-target {{ app()->getLocale() === 'fr' ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }}"
                   @click="open = false">
                    <span class="text-base mr-2">🇫🇷</span>
                    <span class="font-medium">Français</span>
                    @if(app()->getLocale() === 'fr')
                        <svg class="w-3 h-3 ml-auto text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    @endif
                </a>
            </div>
        </div>
    @endif
</div> 