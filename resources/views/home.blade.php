@extends('layout')

@section('title', __('messages.fitlife_gym') . ' - ' . __('messages.your_fitness_journey_starts_here'))

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">
                {{ __('messages.transform_your_body') }}
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                {{ __('messages.join_fitlife_description') }}
            </p>
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition duration-300">
                    {{ __('messages.start_your_journey') }}
                </a>
                <a href="{{ route('packages') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-gray-900 transition duration-300">
                    {{ __('messages.view_packages') }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold text-blue-600 mb-2">500+</div>
                <div class="text-gray-600">{{ __('messages.happy_members') }}</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-blue-600 mb-2">50+</div>
                <div class="text-gray-600">{{ __('messages.modern_equipment') }}</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-blue-600 mb-2">15+</div>
                <div class="text-gray-600">{{ __('messages.expert_trainers') }}</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-blue-600 mb-2">3</div>
                <div class="text-gray-600">{{ __('messages.years_experience') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.why_choose_fitlife') }}</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                {{ __('messages.why_choose_description') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="text-5xl mb-4">🏋️‍♂️</div>
                <h3 class="text-2xl font-semibold mb-4">{{ __('messages.modern_equipment') }}</h3>
                <p class="text-gray-600">{{ __('messages.modern_equipment_desc') }}</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="text-5xl mb-4">👨‍🏫</div>
                <h3 class="text-2xl font-semibold mb-4">{{ __('messages.expert_trainers') }}</h3>
                <p class="text-gray-600">{{ __('messages.expert_trainers_desc') }}</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="text-5xl mb-4">⏰</div>
                <h3 class="text-2xl font-semibold mb-4">{{ __('messages.flexible_hours') }}</h3>
                <p class="text-gray-600">{{ __('messages.flexible_hours_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
@if($services->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.our_services') }}</h2>
            <p class="text-xl text-gray-600">{{ __('messages.our_services_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-semibold mb-3">{{ $service->translated_name }}</h3>
                <p class="text-gray-600 mb-4">{{ $service->translated_description }}</p>
                @if($service->price)
                    <div class="text-blue-600 font-semibold">{{ number_format($service->price) }} FCFA</div>
                @endif
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                {{ __('messages.view_all_services') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Packages Preview -->
@if($packages->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.membership_packages') }}</h2>
            <p class="text-xl text-gray-600">{{ __('messages.membership_packages_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($packages as $package)
            <div class="bg-white p-8 rounded-lg shadow-lg relative">
                @if($package->duration_months >= 6)
                    <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 px-3 py-1 rounded-bl-lg font-semibold text-sm">
                        {{ __('messages.popular') }}
                    </div>
                @endif
                
                <h3 class="text-2xl font-bold mb-4">{{ $package->translated_name }}</h3>
                <div class="text-4xl font-bold text-blue-600 mb-2">{{ number_format($package->price) }}</div>
                <div class="text-gray-600 mb-6">FCFA / {{ $package->duration_months }} {{ $package->duration_months > 1 ? __('messages.months') : __('messages.month') }}</div>
                
                <p class="text-gray-600 mb-6">{{ $package->translated_description }}</p>
                
                @if($package->features)
                    <ul class="space-y-2 mb-6">
                        @foreach($package->translated_features as $feature)
                            <li class="flex items-center">
                                <span class="text-green-500 mr-2">✓</span>
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                
                <a href="{{ route('register') }}" class="w-full bg-blue-600 text-white py-3 rounded-lg text-center block hover:bg-blue-700 transition duration-300">
                    {{ __('messages.choose_package') }}
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('packages') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                {{ __('messages.view_all_packages') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Announcements -->
@if($announcements->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.latest_news') }}</h2>
            <p class="text-xl text-gray-600">{{ __('messages.latest_news_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($announcements as $announcement)
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="flex items-center mb-3">
                    @if($announcement->priority === 'urgent')
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-sm mr-2">{{ __('messages.urgent') }}</span>
                    @elseif($announcement->priority === 'high')
                        <span class="bg-orange-500 text-white px-2 py-1 rounded text-sm mr-2">{{ __('messages.high') }}</span>
                    @endif
                    <span class="text-gray-500 text-sm">{{ $announcement->published_at->format('M d, Y') }}</span>
                </div>
                <h3 class="text-xl font-semibold mb-3">{{ $announcement->title }}</h3>
                <p class="text-gray-600">{{ Str::limit($announcement->content, 100) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">{{ __('messages.ready_start_journey') }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ __('messages.ready_start_description') }}
        </p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition duration-300">
                {{ __('messages.join_today') }}
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                {{ __('messages.contact_us') }}
            </a>
        </div>
    </div>
</section>
@endsection 