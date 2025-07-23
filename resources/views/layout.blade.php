<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>@yield('title', __('messages.fitlife_gym') . ' - ' . __('messages.your_fitness_journey_starts_here'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Custom Styles -->
    <style>
        [x-cloak] { display: none !important; }
        
        /* Mobile-first responsive improvements */
        @media (max-width: 640px) {
            .mobile-padding { padding-left: 1rem; padding-right: 1rem; }
            .mobile-text-sm { font-size: 0.875rem; }
            .mobile-text-xs { font-size: 0.75rem; }
        }
        
        /* Touch-friendly buttons */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Better mobile form inputs */
        @media (max-width: 640px) {
            input, textarea, select {
                font-size: 16px !important; /* Prevents zoom on iOS */
            }
        }
    </style>
</head>
<body class="bg-gray-50 antialiased min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14 sm:h-16">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center touch-target">
                        <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600 truncate">{{ __('messages.fitlife_gym') }}</h1>
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="open = !open" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-blue-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 touch-target"
                            :class="{ 'text-blue-600 bg-gray-100': open }">
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg class="h-6 w-6" :class="{ 'hidden': open, 'block': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close icon -->
                        <svg class="h-6 w-6" :class="{ 'block': open, 'hidden': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-4 lg:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.about') }}
                    </a>
                    <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('services') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.services') }}
                    </a>
                    <a href="{{ route('packages') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('packages') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.packages') }}
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.contact') }}
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors {{ request()->routeIs('dashboard*') ? 'text-blue-600 font-semibold' : '' }}">
                            {{ __('messages.dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            {{ __('messages.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                            {{ __('messages.join_now') }}
                        </a>
                    @endauth
                    
                    <a href="/admin" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        {{ __('messages.admin') }}
                    </a>

                    <!-- Language Switcher -->
                    <x-language-switcher class="ml-2" />
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" x-cloak 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200 shadow-lg">
                <a href="{{ route('home') }}" 
                   class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50 font-semibold' : '' }}"
                   @click="open = false">
                    {{ __('messages.home') }}
                </a>
                <a href="{{ route('about') }}" 
                   class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target {{ request()->routeIs('about') ? 'text-blue-600 bg-blue-50 font-semibold' : '' }}"
                   @click="open = false">
                    {{ __('messages.about') }}
                </a>
                <a href="{{ route('services') }}" 
                   class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target {{ request()->routeIs('services') ? 'text-blue-600 bg-blue-50 font-semibold' : '' }}"
                   @click="open = false">
                    {{ __('messages.services') }}
                </a>
                <a href="{{ route('packages') }}" 
                   class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target {{ request()->routeIs('packages') ? 'text-blue-600 bg-blue-50 font-semibold' : '' }}"
                   @click="open = false">
                    {{ __('messages.packages') }}
                </a>
                <a href="{{ route('contact') }}" 
                   class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50 font-semibold' : '' }}"
                   @click="open = false">
                    {{ __('messages.contact') }}
                </a>
                
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target {{ request()->routeIs('dashboard*') ? 'text-blue-600 bg-blue-50 font-semibold' : '' }}"
                       @click="open = false">
                        {{ __('messages.dashboard') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" 
                       class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target"
                       @click="open = false">
                        {{ __('messages.login') }}
                    </a>
                    <a href="{{ route('register') }}" 
                       class="block px-3 py-3 rounded-md text-base font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors touch-target mx-3 text-center"
                       @click="open = false">
                        {{ __('messages.join_now') }}
                    </a>
                @endauth
                
                <a href="/admin" 
                   class="block px-3 py-3 rounded-md text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-gray-50 transition-colors touch-target"
                   @click="open = false">
                    {{ __('messages.admin') }}
                </a>

                <!-- Mobile Language Switcher -->
                <div class="px-3 py-2">
                    <x-language-switcher :mobile="true" />
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <div class="col-span-1 sm:col-span-2 lg:col-span-2">
                    <h3 class="text-xl sm:text-2xl font-bold text-blue-400 mb-3 sm:mb-4">{{ __('messages.fitlife_gym') }}</h3>
                    <p class="text-gray-300 mb-4 text-sm sm:text-base leading-relaxed">
                        {{ __('messages.fitness_journey_description') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors touch-target">Facebook</a>
                        <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors touch-target">Instagram</a>
                        <a href="#" class="text-gray-300 hover:text-blue-400 transition-colors touch-target">Twitter</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">{{ __('messages.quick_links') }}</h4>
                    <ul class="space-y-2 text-sm sm:text-base">
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-blue-400 transition-colors touch-target block py-1">{{ __('messages.about') }}</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-blue-400 transition-colors touch-target block py-1">{{ __('messages.services') }}</a></li>
                        <li><a href="{{ route('packages') }}" class="text-gray-300 hover:text-blue-400 transition-colors touch-target block py-1">{{ __('messages.packages') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-blue-400 transition-colors touch-target block py-1">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-base sm:text-lg font-semibold mb-3 sm:mb-4">{{ __('messages.contact_info') }}</h4>
                    <ul class="space-y-2 text-gray-300 text-sm sm:text-base">
                        <li class="flex items-start">
                            <span class="mr-2">📍</span>
                            <span>123 Fitness Street, City Center</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">📞</span>
                            <a href="tel:+237123456789" class="hover:text-blue-400 transition-colors">+237 123 456 789</a>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2">✉️</span>
                            <a href="mailto:info@fitlifegym.com" class="hover:text-blue-400 transition-colors">info@fitlifegym.com</a>
                        </li>
                        <li><span class="mr-2">🕒</span>{{ __('messages.mon_fri') }}</li>
                        <li><span class="mr-2">🕒</span>{{ __('messages.sat_sun') }}</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 sm:mt-8 pt-6 sm:pt-8 text-center text-gray-300 text-sm">
                <p>&copy; {{ date('Y') }} {{ __('messages.fitlife_gym') }}. {{ __('messages.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html> 