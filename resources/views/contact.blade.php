@extends('layout')

@section('title', __('messages.contact_us') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12 sm:py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 leading-tight">{{ __('messages.contact_us') }}</h1>
        <p class="text-base sm:text-lg lg:text-xl max-w-3xl mx-auto leading-relaxed">
            {{ __('messages.get_in_touch') }}. {{ __('messages.here_to_help') }}
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-12 sm:py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Contact Form -->
            <div class="order-2 lg:order-1">
                <div class="bg-gray-50 p-4 sm:p-6 lg:p-8 rounded-lg">
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.send_message') }}</h2>
                    
                    <form class="space-y-4 sm:space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('messages.first_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="first_name" 
                                       name="first_name" 
                                       class="w-full px-3 sm:px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base touch-target" 
                                       placeholder="{{ __('messages.enter_first_name') }}"
                                       required>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('messages.last_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="last_name" 
                                       name="last_name" 
                                       class="w-full px-3 sm:px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base touch-target" 
                                       placeholder="{{ __('messages.enter_last_name') }}"
                                       required>
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.email_address') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="w-full px-3 sm:px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base touch-target" 
                                   placeholder="{{ __('messages.enter_email') }}"
                                   required>
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.phone_number') }}
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="w-full px-3 sm:px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base touch-target" 
                                   placeholder="{{ __('messages.enter_phone') }}">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.subject') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="subject" 
                                    name="subject" 
                                    class="w-full px-3 sm:px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base touch-target" 
                                    required>
                                <option value="">{{ __('messages.select_subject') }}</option>
                                <option value="membership">{{ __('messages.membership_inquiry') }}</option>
                                <option value="services">{{ __('messages.services_inquiry') }}</option>
                                <option value="personal_training">{{ __('messages.personal_training_inquiry') }}</option>
                                <option value="group_classes">{{ __('messages.group_classes_inquiry') }}</option>
                                <option value="facilities">{{ __('messages.facilities_inquiry') }}</option>
                                <option value="billing">{{ __('messages.billing_inquiry') }}</option>
                                <option value="technical">{{ __('messages.technical_support') }}</option>
                                <option value="feedback">{{ __('messages.feedback_suggestions') }}</option>
                                <option value="other">{{ __('messages.other') }}</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('messages.message') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" 
                                      name="message" 
                                      rows="5" 
                                      class="w-full px-3 sm:px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none text-sm sm:text-base" 
                                      placeholder="{{ __('messages.enter_message') }}"
                                      required></textarea>
                        </div>
                        
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   id="privacy_consent" 
                                   name="privacy_consent" 
                                   class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                                   required>
                            <label for="privacy_consent" class="ml-3 text-xs sm:text-sm text-gray-600 leading-relaxed">
                                {{ __('messages.privacy_consent') }}
                            </label>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white py-3 sm:py-4 px-6 rounded-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-colors text-sm sm:text-base touch-target">
                            {{ __('messages.send_message') }}
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="order-1 lg:order-2">
                <div class="space-y-6 sm:space-y-8">
                    <div>
                        <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('messages.get_in_touch') }}</h2>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            {{ __('messages.contact_description') }}
                        </p>
                    </div>
                    
                    <!-- Contact Details -->
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-start p-4 sm:p-6 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">{{ __('messages.visit_us') }}</h3>
                                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                                    123 Fitness Street<br>
                                    City Center, Douala<br>
                                    Cameroon
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 sm:p-6 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">{{ __('messages.call_us') }}</h3>
                                <div class="space-y-1 text-sm sm:text-base">
                                    <p class="text-gray-600">
                                        <a href="tel:+237123456789" class="hover:text-blue-600 transition-colors">+237 123 456 789</a>
                                    </p>
                                    <p class="text-gray-600">
                                        <a href="tel:+237987654321" class="hover:text-blue-600 transition-colors">+237 987 654 321</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 sm:p-6 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">{{ __('messages.email_us') }}</h3>
                                <div class="space-y-1 text-sm sm:text-base">
                                    <p class="text-gray-600">
                                        <a href="mailto:info@fitlifegym.com" class="hover:text-blue-600 transition-colors">info@fitlifegym.com</a>
                                    </p>
                                    <p class="text-gray-600">
                                        <a href="mailto:support@fitlifegym.com" class="hover:text-blue-600 transition-colors">support@fitlifegym.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-start p-4 sm:p-6 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1 text-sm sm:text-base">{{ __('messages.hours_operation') }}</h3>
                                <div class="space-y-1 text-gray-600 text-sm sm:text-base">
                                    <p>{{ __('messages.mon_fri') }}: 5:00 AM - 11:00 PM</p>
                                    <p>{{ __('messages.sat_sun') }}: 6:00 AM - 10:00 PM</p>
                                    <p class="text-xs sm:text-sm text-gray-500 mt-2">{{ __('messages.holiday_hours_note') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-4 text-sm sm:text-base">{{ __('messages.follow_us') }}</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors touch-target">
                                <span class="sr-only">Facebook</span>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 sm:w-12 sm:h-12 bg-pink-600 text-white rounded-lg flex items-center justify-center hover:bg-pink-700 transition-colors touch-target">
                                <span class="sr-only">Instagram</span>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987c6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297L3.182 17.635l1.944-1.944c-.807-.875-1.297-2.026-1.297-3.323s.49-2.448 1.297-3.323L3.182 7.101l1.944-1.944c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297l1.944 1.944L15.66 9.045c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323l1.944 1.944-1.944 1.944c-.875.807-2.026 1.297-3.323 1.297z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-400 text-white rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors touch-target">
                                <span class="sr-only">Twitter</span>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-10 h-10 sm:w-12 sm:h-12 bg-red-600 text-white rounded-lg flex items-center justify-center hover:bg-red-700 transition-colors touch-target">
                                <span class="sr-only">YouTube</span>
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">{{ __('messages.find_us') }}</h2>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.convenient_location') }}</p>
        </div>
        
        <div class="bg-gray-300 rounded-lg h-64 sm:h-80 lg:h-96 flex items-center justify-center">
            <div class="text-center">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <p class="text-gray-600 text-sm sm:text-base">{{ __('messages.interactive_map') }}</p>
                <p class="text-gray-500 text-xs sm:text-sm mt-2">123 Fitness Street, City Center, Douala</p>
            </div>
        </div>
        
        <div class="mt-6 sm:mt-8 text-center">
            <a href="https://maps.google.com" 
               target="_blank" 
               class="inline-flex items-center px-4 sm:px-6 py-3 sm:py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold text-sm sm:text-base touch-target">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                {{ __('messages.get_directions') }}
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">{{ __('messages.frequently_asked') }}</h2>
            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.quick_answers') }}</p>
        </div>
        
        <div class="space-y-4 sm:space-y-6" x-data="{ open: null }">
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 1 ? null : 1" 
                    class="w-full px-4 sm:px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition-colors touch-target">
                    <div class="flex justify-between items-center">
                        <span class="text-sm sm:text-base">{{ __('messages.what_are_hours') }}</span>
                        <span x-text="open === 1 ? '−' : '+'" class="text-lg"></span>
                    </div>
                </button>
                <div x-show="open === 1" x-cloak class="px-4 sm:px-6 pb-4">
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.hours_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 2 ? null : 2" 
                    class="w-full px-4 sm:px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition-colors touch-target">
                    <div class="flex justify-between items-center">
                        <span class="text-sm sm:text-base">{{ __('messages.do_you_offer_tours') }}</span>
                        <span x-text="open === 2 ? '−' : '+'" class="text-lg"></span>
                    </div>
                </button>
                <div x-show="open === 2" x-cloak class="px-4 sm:px-6 pb-4">
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.tours_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 3 ? null : 3" 
                    class="w-full px-4 sm:px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition-colors touch-target">
                    <div class="flex justify-between items-center">
                        <span class="text-sm sm:text-base">{{ __('messages.parking_available') }}</span>
                        <span x-text="open === 3 ? '−' : '+'" class="text-lg"></span>
                    </div>
                </button>
                <div x-show="open === 3" x-cloak class="px-4 sm:px-6 pb-4">
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">{{ __('messages.parking_answer') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 