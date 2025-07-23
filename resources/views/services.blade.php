@extends('layout')

@section('title', __('messages.our_services_title') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 leading-tight">{{ __('messages.our_services_title') }}</h1>
        <p class="text-base sm:text-lg lg:text-xl max-w-3xl mx-auto leading-relaxed">
            {{ __('messages.discover_services') }}
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-12 sm:py-16 lg:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                @foreach($services as $service)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <!-- Service Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-4 sm:p-6">
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mb-2">{{ $service->translated_name }}</h3>
                        @if($service->price)
                            <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-yellow-300">
                                {{ number_format($service->price) }} <span class="text-sm font-normal">FCFA</span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Service Details -->
                    <div class="p-4 sm:p-6">
                        <p class="text-gray-600 mb-4 text-sm sm:text-base leading-relaxed">{{ $service->translated_description }}</p>
                        
                        <!-- Service Meta Info -->
                        <div class="space-y-2 mb-6">
                            @if($service->duration_minutes)
                                <div class="flex items-center text-sm sm:text-base text-gray-500">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $service->duration_minutes }} {{ __('messages.minutes') }}</span>
                                </div>
                            @endif
                            
                            @if($service->max_participants)
                                <div class="flex items-center text-sm sm:text-base text-gray-500">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>{{ __('messages.max') }} {{ $service->max_participants }} {{ $service->max_participants == 1 ? __('messages.person') : __('messages.people') }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- CTA Button -->
                        <a href="{{ route('register') }}" 
                           class="w-full bg-blue-600 text-white py-3 sm:py-4 px-4 rounded-lg text-center font-semibold hover:bg-blue-700 transition-colors block text-sm sm:text-base touch-target">
                            {{ __('messages.book_now') }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- No Services Available -->
            <div class="text-center py-12 sm:py-16">
                <div class="max-w-md mx-auto px-4">
                    <svg class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 mx-auto text-gray-400 mb-4 sm:mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-900 mb-3">{{ __('messages.no_services_available') }}</h3>
                    <p class="text-gray-600 mb-6 text-sm sm:text-base leading-relaxed">{{ __('messages.updating_services') }}</p>
                    <a href="{{ route('contact') }}" 
                       class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-sm sm:text-base touch-target">
                        {{ __('messages.contact_us') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Service Categories -->
<section class="py-12 sm:py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.why_choose_services') }}</h2>
            <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ __('messages.certified_trainers_desc') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">
            <div class="text-center p-4 sm:p-6">
                <div class="bg-blue-100 w-16 h-16 sm:w-20 sm:h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-base sm:text-lg lg:text-xl font-semibold mb-2">{{ __('messages.certified_trainers') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.certified_trainers_desc') }}</p>
            </div>
            
            <div class="text-center p-4 sm:p-6">
                <div class="bg-green-100 w-16 h-16 sm:w-20 sm:h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-base sm:text-lg lg:text-xl font-semibold mb-2">{{ __('messages.high_energy') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.high_energy_desc') }}</p>
            </div>
            
            <div class="text-center p-4 sm:p-6">
                <div class="bg-purple-100 w-16 h-16 sm:w-20 sm:h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-base sm:text-lg lg:text-xl font-semibold mb-2">{{ __('messages.community_service') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.community_service_desc') }}</p>
            </div>
            
            <div class="text-center p-4 sm:p-6">
                <div class="bg-yellow-100 w-16 h-16 sm:w-20 sm:h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-base sm:text-lg lg:text-xl font-semibold mb-2">{{ __('messages.track_progress_service') }}</h3>
                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.track_progress_service_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-4 sm:mb-6">{{ __('messages.ready_to_get_started') }}</h2>
        <p class="text-base sm:text-lg lg:text-xl mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed">
            {{ __('messages.take_first_step') }}
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