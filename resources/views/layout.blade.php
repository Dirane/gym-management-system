<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    </style>
</head>
<body class="bg-gray-50 antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
                        <h1 class="text-2xl font-bold text-blue-600">{{ __('messages.fitlife_gym') }}</h1>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.home') }}
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.about') }}
                    </a>
                    <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('services') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.services') }}
                    </a>
                    <a href="{{ route('packages') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('packages') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.packages') }}
                    </a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('contact') ? 'text-blue-600 font-semibold' : '' }}">
                        {{ __('messages.contact') }}
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 font-semibold' : '' }}">
                            {{ __('messages.dashboard') }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('login') ? 'text-blue-600 font-semibold' : '' }}">
                            {{ __('messages.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition duration-300">
                            {{ __('messages.join_now') }}
                        </a>
                    @endauth
                    
                    <a href="{{ route('test-credentials') }}" class="text-blue-600 hover:text-blue-800 px-3 py-2 rounded-md text-sm font-medium">
                        {{ __('messages.test_login') }}
                    </a>
                    
                    <a href="/admin" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                        {{ __('messages.admin') }}
                    </a>

                    <!-- Language Switcher -->
                    <x-language-switcher class="ml-4" />
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-gray-700 hover:text-blue-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="open" x-cloak class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.about') }}</a>
                <a href="{{ route('services') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.services') }}</a>
                <a href="{{ route('packages') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.packages') }}</a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.contact') }}</a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.dashboard') }}</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium w-full text-left">
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.login') }}</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.join_now') }}</a>
                @endauth
                
                <a href="{{ route('test-credentials') }}" class="text-blue-600 hover:text-blue-800 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.test_login') }}</a>
                
                <a href="/admin" class="text-gray-700 hover:text-blue-600 block px-3 py-2 rounded-md text-base font-medium">{{ __('messages.admin') }}</a>

                <!-- Mobile Language Switcher -->
                <x-language-switcher :mobile="true" />
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold text-blue-400 mb-4">{{ __('messages.fitlife_gym') }}</h3>
                    <p class="text-gray-300 mb-4">
                        {{ __('messages.fitness_journey_description') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-blue-400">Facebook</a>
                        <a href="#" class="text-gray-300 hover:text-blue-400">Instagram</a>
                        <a href="#" class="text-gray-300 hover:text-blue-400">Twitter</a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">{{ __('messages.quick_links') }}</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-blue-400">{{ __('messages.about') }}</a></li>
                        <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-blue-400">{{ __('messages.services') }}</a></li>
                        <li><a href="{{ route('packages') }}" class="text-gray-300 hover:text-blue-400">{{ __('messages.packages') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-blue-400">{{ __('messages.contact') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">{{ __('messages.contact_info') }}</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>📍 123 Fitness Street, City Center</li>
                        <li>📞 +237 123 456 789</li>
                        <li>✉️ info@fitlifegym.com</li>
                        <li>🕒 {{ __('messages.mon_fri') }}</li>
                        <li>🕒 {{ __('messages.sat_sun') }}</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>&copy; {{ date('Y') }} {{ __('messages.fitlife_gym') }}. {{ __('messages.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html> 