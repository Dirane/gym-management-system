@extends('layout')

@section('title', __('messages.membership_packages') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ __('messages.membership_packages') }}</h1>
        <p class="text-xl max-w-3xl mx-auto">
            {{ __('messages.choose_perfect_plan') }}. {{ __('messages.all_packages_include') }} access to our modern facilities and equipment.
        </p>
    </div>
</section>

<!-- Packages -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($packages->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden relative
                    {{ $package->duration_months >= 6 ? 'ring-2 ring-yellow-400 transform scale-105' : '' }}">
                    
                    @if($package->duration_months >= 6)
                        <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 px-4 py-2 rounded-bl-lg font-bold text-sm">
                            {{ __('messages.most_popular') }}
                        </div>
                    @endif
                    
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $package->translated_name }}</h3>
                            <div class="text-5xl font-bold text-blue-600 mb-2">{{ number_format($package->price) }}</div>
                            <div class="text-gray-600 text-lg">
                                FCFA / {{ $package->duration_months }} {{ $package->duration_months > 1 ? __('messages.months') : __('messages.month') }}
                            </div>
                            @if($package->duration_months > 1)
                                <div class="text-sm text-green-600 font-semibold mt-2">
                                    {{ __('messages.save') }} {{ number_format((10000 * $package->duration_months) - $package->price) }} FCFA!
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-8">
                            <p class="text-gray-600 text-center">{{ $package->translated_description }}</p>
                        </div>
                        
                        @if($package->features && count($package->features) > 0)
                            <div class="mb-8">
                                <h4 class="font-semibold text-gray-900 mb-4">{{ __('messages.all_memberships_include') }}</h4>
                                <ul class="space-y-3">
                                    @foreach($package->translated_features as $feature)
                                        <li class="flex items-start">
                                            <span class="text-green-500 text-xl mr-3 mt-0.5">✓</span>
                                            <span class="text-gray-600">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="space-y-3">
                            <a href="{{ route('register') }}" 
                                class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg text-center font-semibold hover:bg-blue-700 transition duration-300 block">
                                {{ __('messages.choose_this_package') }}
                            </a>
                            <a href="{{ route('contact') }}" 
                                class="w-full border-2 border-blue-600 text-blue-600 py-3 px-6 rounded-lg text-center font-semibold hover:bg-blue-600 hover:text-white transition duration-300 block">
                                {{ __('messages.learn_more') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">{{ __('messages.no_packages_available_title') }}</h3>
                <p class="text-gray-600 mb-6">{{ __('messages.no_packages_available_desc') }}</p>
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    {{ __('messages.contact_us_for_info') }}
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Membership Benefits -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('messages.all_memberships_include') }}</h2>
            <p class="text-xl text-gray-600">{{ __('messages.all_packages_include') }}</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-5xl mb-4">🏋️‍♂️</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.full_equipment_access') }}</h3>
                <p class="text-gray-600">{{ __('messages.full_equipment_access_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">🚿</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.locker_rooms_showers') }}</h3>
                <p class="text-gray-600">{{ __('messages.locker_rooms_showers_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">📱</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.mobile_app_access') }}</h3>
                <p class="text-gray-600">{{ __('messages.mobile_app_access_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">🅿️</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.free_parking') }}</h3>
                <p class="text-gray-600">{{ __('messages.free_parking_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">💪</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.fitness_assessment') }}</h3>
                <p class="text-gray-600">{{ __('messages.fitness_assessment_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">🏃‍♀️</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.group_classes_benefit') }}</h3>
                <p class="text-gray-600">{{ __('messages.group_classes_benefit_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">📊</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.progress_tracking') }}</h3>
                <p class="text-gray-600">{{ __('messages.progress_tracking_desc') }}</p>
            </div>
            
            <div class="text-center">
                <div class="text-5xl mb-4">🎯</div>
                <h3 class="text-xl font-semibold mb-3">{{ __('messages.goal_setting') }}</h3>
                <p class="text-gray-600">{{ __('messages.goal_setting_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Information -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.pricing_information') }}</h2>
            <p class="text-lg text-gray-600">{{ __('messages.transparent_pricing') }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('messages.membership_fees') }}</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('messages.registration_fee') }}</span>
                            <span class="font-semibold">5,000 FCFA</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('messages.monthly_membership') }}</span>
                            <span class="font-semibold">10,000 FCFA</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('messages.six_month_package') }}</span>
                            <span class="font-semibold">50,000 FCFA</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('messages.annual_package') }}</span>
                            <span class="font-semibold">90,000 FCFA</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">{{ __('messages.payment_options') }}</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✓</span>
                            {{ __('messages.cash_payments') }}
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✓</span>
                            {{ __('messages.credit_debit_cards') }}
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✓</span>
                            {{ __('messages.mobile_money') }}
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✓</span>
                            {{ __('messages.bank_transfers') }}
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-2">✓</span>
                            {{ __('messages.flexible_payment_plans') }}
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                <div class="flex items-start">
                    <div class="text-blue-500 text-xl mr-3">💡</div>
                    <div>
                        <h4 class="font-semibold text-blue-900 mb-2">{{ __('messages.money_back_guarantee') }}</h4>
                        <p class="text-blue-800 text-sm">
                            {{ __('messages.money_back_desc') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('messages.membership_faq') }}</h2>
            <p class="text-lg text-gray-600">{{ __('messages.faq_quick_answers') }}</p>
        </div>
        
        <div class="space-y-6" x-data="{ open: null }">
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 1 ? null : 1" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.upgrade_downgrade_question') }}</span>
                        <span x-text="open === 1 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 1" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.upgrade_downgrade_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 2 ? null : 2" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.cancel_membership_question') }}</span>
                        <span x-text="open === 2 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 2" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.cancel_membership_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 3 ? null : 3" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.additional_fees_question') }}</span>
                        <span x-text="open === 3 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 3" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.additional_fees_answer') }}</p>
                </div>
            </div>
            
            <div class="border border-gray-200 rounded-lg">
                <button @click="open = open === 4 ? null : 4" 
                    class="w-full px-6 py-4 text-left font-semibold text-gray-900 hover:bg-gray-50 transition duration-300">
                    <div class="flex justify-between items-center">
                        <span>{{ __('messages.faq_freeze_question') }}</span>
                        <span x-text="open === 4 ? '−' : '+'"></span>
                    </div>
                </button>
                <div x-show="open === 4" x-cloak class="px-6 pb-4">
                    <p class="text-gray-600">{{ __('messages.faq_freeze_answer') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">{{ __('messages.ready_transform_life') }}</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            {{ __('messages.choose_perfect_membership') }}
        </p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition duration-300">
                {{ __('messages.join_now') }}
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                {{ __('messages.get_free_tour') }}
            </a>
        </div>
    </div>
</section>
@endsection 