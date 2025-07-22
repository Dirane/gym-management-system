@extends('layout')

@section('title', __('messages.contact_us') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ __('messages.contact_us') }}</h1>
        <p class="text-xl max-w-3xl mx-auto">
            {{ __('messages.get_in_touch') }}
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Info -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('messages.get_in_touch_title') }}</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="text-2xl mr-4">📍</div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">{{ __('messages.address') }}</h3>
                            <p class="text-gray-600">
                                123 Fitness Street<br>
                                City Center, Cameroon<br>
                                Near Central Market
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="text-2xl mr-4">📞</div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">{{ __('messages.phone') }}</h3>
                            <p class="text-gray-600">+237 123 456 789</p>
                            <p class="text-gray-600">+237 987 654 321</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="text-2xl mr-4">✉️</div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">{{ __('messages.email') }}</h3>
                            <p class="text-gray-600">info@fitlifegym.com</p>
                            <p class="text-gray-600">membership@fitlifegym.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="text-2xl mr-4">🕒</div>
                        <div>
                            <h3 class="text-lg font-semibold mb-2">{{ __('messages.opening_hours') }}</h3>
                            <div class="text-gray-600 space-y-1">
                                <p>Monday - Friday: 6:00 AM - 10:00 PM</p>
                                <p>Saturday: 8:00 AM - 8:00 PM</p>
                                <p>Sunday: 8:00 AM - 6:00 PM</p>
                                <p class="text-sm text-blue-600 mt-2">24/7 access available for premium members</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.follow_us') }}</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition duration-300">
                            <span class="sr-only">Facebook</span>
                            📘
                        </a>
                        <a href="#" class="bg-pink-600 text-white p-3 rounded-full hover:bg-pink-700 transition duration-300">
                            <span class="sr-only">Instagram</span>
                            📷
                        </a>
                        <a href="#" class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition duration-300">
                            <span class="sr-only">Twitter</span>
                            🐦
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="bg-gray-50 p-8 rounded-lg">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">{{ __('messages.send_us_message') }}</h2>
                
                <form x-data="{ sent: false }" @submit.prevent="sent = true" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.first_name') }}</label>
                            <input type="text" id="first_name" name="first_name" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.last_name') }}</label>
                            <input type="text" id="last_name" name="last_name" required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email_address') }}</label>
                        <input type="email" id="email" name="email" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.phone_number') }}</label>
                        <input type="tel" id="phone" name="phone" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="+237 XXX XXX XXX">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.subject') }}</label>
                        <select id="subject" name="subject" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">{{ __('messages.select_subject') }}</option>
                            <option value="membership">{{ __('messages.membership_inquiry') }}</option>
                            <option value="personal_training">{{ __('messages.personal_training') }}</option>
                            <option value="group_classes">{{ __('messages.group_classes') }}</option>
                            <option value="facility_tour">{{ __('messages.facility_tour') }}</option>
                            <option value="general">{{ __('messages.general_information') }}</option>
                            <option value="complaint">{{ __('messages.complaint_feedback') }}</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.message') }}</label>
                        <textarea id="message" name="message" rows="5" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="{{ __('messages.message_placeholder') }}"></textarea>
                    </div>
                    
                    <div x-show="!sent">
                        <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-300">
                            {{ __('messages.send_message') }}
                        </button>
                    </div>
                    
                    <div x-show="sent" x-cloak class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="text-green-500 text-xl mr-3">✓</div>
                            <div>
                                <h3 class="text-green-800 font-semibold">{{ __('messages.message_sent_success') }}</h3>
                                <p class="text-green-700 text-sm mt-1">{{ __('messages.message_sent_thank_you') }}</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.find_us_title') }}</h2>
            <p class="text-lg text-gray-600">{{ __('messages.visit_facility') }}</p>
        </div>
        
        <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center">
            <div class="text-center">
                <div class="text-6xl mb-4">🗺️</div>
                <p class="text-gray-600 text-lg">Interactive Map</p>
                <p class="text-gray-500 text-sm">123 Fitness Street, City Center</p>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            <div class="text-center p-6 bg-white rounded-lg shadow">
                <div class="text-3xl mb-3">🚇</div>
                <h3 class="font-semibold mb-2">{{ __('messages.public_transport_title') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.public_transport_desc') }}</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow">
                <div class="text-3xl mb-3">🅿️</div>
                <h3 class="font-semibold mb-2">{{ __('messages.free_parking_title') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.free_parking_contact_desc') }}</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow">
                <div class="text-3xl mb-3">🏪</div>
                <h3 class="font-semibold mb-2">{{ __('messages.shopping_center_title') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.shopping_center_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.faq_section_title') }}</h2>
            <p class="text-lg text-gray-600">{{ __('messages.faq_quick_answers') }}</p>
        </div>
        
        <div class="space-y-6" x-data="{ open: null }">
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 1 ? null : 1" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.membership_options_question') }}</span>
                        <span x-text="open === 1 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 1" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.membership_options_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 2 ? null : 2" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.faq_personal_training_question') }}</span>
                        <span x-text="open === 2 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 2" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.faq_personal_training_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 3 ? null : 3" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.faq_trial_question') }}</span>
                        <span x-text="open === 3 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 3" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.faq_trial_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 4 ? null : 4" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.faq_safety_question') }}</span>
                        <span x-text="open === 4 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 4" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.faq_safety_answer') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">{{ __('messages.ready_start_journey') }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ __('messages.visit_us_today') }}
        </p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition duration-300">
                {{ __('messages.join_now') }}
            </a>
            <a href="tel:+237123456789" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                {{ __('messages.call_us_now') }}
            </a>
        </div>
    </div>
</section>
@endsection 