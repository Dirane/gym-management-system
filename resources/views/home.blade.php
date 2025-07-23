@extends('layout')

@section('title', __('messages.fitlife_gym') . ' - ' . __('messages.your_fitness_journey_starts_here'))

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-purple-700 text-white overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
        <div class="text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 leading-tight">
                {{ __('messages.transform_your_body') }}
            </h1>
            <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed px-4">
                {{ __('messages.join_fitlife_description') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center px-4">
                <a href="{{ route('register') }}" 
                   class="w-full sm:w-auto bg-yellow-400 text-gray-900 px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold hover:bg-yellow-300 transition-colors touch-target text-center">
                    {{ __('messages.start_your_journey') }}
                </a>
                <a href="{{ route('packages') }}" 
                   class="w-full sm:w-auto border-2 border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors touch-target text-center">
                    {{ __('messages.view_packages') }}
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
            <div class="text-center p-4 sm:p-6">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-2">500+</div>
                <div class="text-sm sm:text-base text-gray-600 font-medium">{{ __('messages.happy_members') }}</div>
            </div>
            <div class="text-center p-4 sm:p-6">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-2">50+</div>
                <div class="text-sm sm:text-base text-gray-600 font-medium">{{ __('messages.modern_equipment') }}</div>
            </div>
            <div class="text-center p-4 sm:p-6">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-2">10+</div>
                <div class="text-sm sm:text-base text-gray-600 font-medium">{{ __('messages.expert_trainers') }}</div>
            </div>
            <div class="text-center p-4 sm:p-6">
                <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mb-2">3+</div>
                <div class="text-sm sm:text-base text-gray-600 font-medium">{{ __('messages.years_experience') }}</div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.why_choose_fitlife') }}</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ __('messages.why_choose_description') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg text-center hover:shadow-xl transition-shadow">
                <div class="text-4xl sm:text-5xl mb-4">🏋️‍♂️</div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-3 sm:mb-4">{{ __('messages.modern_equipment') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.modern_equipment_desc') }}</p>
            </div>
            
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg text-center hover:shadow-xl transition-shadow">
                <div class="text-4xl sm:text-5xl mb-4">👨‍🏫</div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-3 sm:mb-4">{{ __('messages.expert_trainers') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.expert_trainers_desc') }}</p>
            </div>
            
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg text-center hover:shadow-xl transition-shadow sm:col-span-2 lg:col-span-1">
                <div class="text-4xl sm:text-5xl mb-4">⏰</div>
                <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold mb-3 sm:mb-4">{{ __('messages.flexible_hours') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.flexible_hours_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
@if($services->count() > 0)
<section class="py-12 sm:py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.our_services') }}</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">{{ __('messages.our_services_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($services as $service)
            <div class="bg-gray-50 p-4 sm:p-6 rounded-lg hover:shadow-lg transition-shadow">
                <h3 class="text-lg sm:text-xl font-semibold mb-3 text-gray-900">{{ $service->translated_name }}</h3>
                <p class="text-gray-600 mb-4 text-sm sm:text-base leading-relaxed">{{ Str::limit($service->translated_description, 120) }}</p>
                @if($service->price)
                    <div class="text-blue-600 font-semibold text-base sm:text-lg">{{ number_format($service->price) }} FCFA</div>
                @endif
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8 sm:mt-12">
            <a href="{{ route('services') }}" 
               class="inline-block bg-blue-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-base sm:text-lg touch-target">
                {{ __('messages.view_all_services') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Packages Preview -->
@if($packages->count() > 0)
<section class="py-12 sm:py-16 lg:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.membership_packages') }}</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">{{ __('messages.membership_packages_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($packages as $package)
            <div class="bg-white p-6 sm:p-8 rounded-lg shadow-lg relative hover:shadow-xl transition-shadow {{ $package->duration_months >= 6 ? 'ring-2 ring-yellow-400 transform scale-105' : '' }}">
                @if($package->duration_months >= 6)
                    <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 px-3 py-1 rounded-bl-lg font-semibold text-xs sm:text-sm">
                        {{ __('messages.popular') }}
                    </div>
                @endif
                
                <div class="text-center mb-6">
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold mb-3 sm:mb-4">{{ $package->translated_name }}</h3>
                    <div class="text-3xl sm:text-4xl font-bold text-blue-600 mb-2">{{ number_format($package->price) }}</div>
                    <div class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base">FCFA / {{ $package->duration_months }} {{ $package->duration_months > 1 ? __('messages.months') : __('messages.month') }}</div>
                </div>
                
                <p class="text-gray-600 mb-4 sm:mb-6 text-sm sm:text-base leading-relaxed text-center">{{ Str::limit($package->translated_description, 100) }}</p>
                
                @if($package->translated_features)
                    <ul class="space-y-2 mb-6 text-sm sm:text-base">
                        @foreach(array_slice($package->translated_features, 0, 4) as $feature)
                            <li class="flex items-start">
                                <span class="text-green-500 mr-2 mt-1 flex-shrink-0">✓</span>
                                <span class="text-gray-600">{{ $feature }}</span>
                            </li>
                        @endforeach
                        @if(count($package->translated_features) > 4)
                            <li class="text-blue-600 text-sm font-medium">+ {{ count($package->translated_features) - 4 }} {{ __('messages.more') }}...</li>
                        @endif
                    </ul>
                @endif
                
                <a href="{{ route('register') }}" 
                   class="w-full bg-blue-600 text-white py-3 rounded-lg text-center block hover:bg-blue-700 transition-colors font-semibold text-sm sm:text-base touch-target">
                    {{ __('messages.choose_package') }}
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-8 sm:mt-12">
            <a href="{{ route('packages') }}" 
               class="inline-block bg-blue-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-base sm:text-lg touch-target">
                {{ __('messages.view_all_packages') }}
            </a>
        </div>
    </div>
</section>
@endif

<!-- Announcements -->
@if($announcements->count() > 0)
<section class="py-12 sm:py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.latest_news') }}</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">{{ __('messages.latest_news_desc') }}</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($announcements as $announcement)
            <div class="bg-gray-50 p-4 sm:p-6 rounded-lg hover:shadow-lg transition-shadow">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    @if($announcement->priority === 'urgent')
                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs font-medium">{{ __('messages.urgent') }}</span>
                    @elseif($announcement->priority === 'high')
                        <span class="bg-orange-500 text-white px-2 py-1 rounded text-xs font-medium">{{ __('messages.high') }}</span>
                    @endif
                    <span class="text-gray-500 text-xs sm:text-sm">{{ $announcement->published_at->format('M d, Y') }}</span>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-3 text-gray-900 leading-tight">{{ $announcement->title }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ Str::limit($announcement->content, 120) }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-4 sm:mb-6">{{ __('messages.ready_start_journey') }}</h2>
        <p class="text-base sm:text-lg lg:text-xl mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed">
            {{ __('messages.ready_start_description') }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center">
            <a href="{{ route('register') }}" 
               class="w-full sm:w-auto bg-yellow-400 text-gray-900 px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold hover:bg-yellow-300 transition-colors touch-target text-center">
                {{ __('messages.join_today') }}
            </a>
            <a href="{{ route('contact') }}" 
               class="w-full sm:w-auto border-2 border-white text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors touch-target text-center">
                {{ __('messages.contact_us') }}
            </a>
        </div>
    </div>
</section>
@endsection 