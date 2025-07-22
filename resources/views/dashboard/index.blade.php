@extends('layout')

@section('title', __('messages.dashboard') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">{{ __('messages.welcome_back_user', ['name' => $user->name]) }}</h1>
                <p class="text-blue-100 text-sm sm:text-base">{{ __('messages.track_membership_desc') }}</p>
            </div>
            <div class="mt-4 sm:mt-0">
                @if($membership && $membership->status === 'active')
                    <a href="{{ route('membership.card') }}" class="bg-yellow-400 text-gray-900 px-4 py-2 sm:px-6 sm:py-3 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300 text-sm sm:text-base">
                        {{ __('messages.view_membership_card') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Dashboard Content -->
<section class="py-8 sm:py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div class="text-sm text-green-700">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-sm text-red-700">{{ session('error') }}</div>
                </div>
            </div>
        @endif

        <!-- Membership Status -->
        <div class="bg-white rounded-lg shadow-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900">{{ __('messages.membership_status') }}</h2>
            </div>
            <div class="px-4 py-5 sm:px-6">
                @if($membership)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-2xl sm:text-3xl font-bold {{ $membership->status === 'active' ? 'text-green-600' : ($membership->status === 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ ucfirst($membership->status) }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">{{ __('messages.status') }}</div>
                        </div>
                        
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-xl sm:text-2xl font-bold text-blue-600">{{ $membership->package->name }}</div>
                            <div class="text-sm text-gray-600 mt-1">{{ __('messages.package') }}</div>
                        </div>
                        
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-xl sm:text-2xl font-bold text-gray-900">{{ $membership->card_number }}</div>
                            <div class="text-sm text-gray-600 mt-1">{{ __('messages.card_number') }}</div>
                        </div>
                        
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <div class="text-xl sm:text-2xl font-bold {{ $membership->end_date > now() ? 'text-green-600' : 'text-red-600' }}">
                                {{ $membership->end_date->format('M d, Y') }}
                            </div>
                            <div class="text-sm text-gray-600 mt-1">{{ __('messages.expires') }}</div>
                        </div>
                    </div>

                    @if($membership->status === 'pending')
                        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="text-sm text-yellow-700">
                                    <p class="font-medium">Payment Required</p>
                                    <p class="mt-1">Your membership is pending. Please complete payment to activate your membership and receive your card.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-500 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Active Membership</h3>
                        <p class="text-gray-600 mb-4">You don't have an active membership yet.</p>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            Get Membership
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pending Payments -->
        @if($pendingPayments->count() > 0)
            <div class="bg-white rounded-lg shadow-lg mb-8">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-900">{{ __('messages.pending_payments') }}</h2>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <div class="space-y-4">
                        @foreach($pendingPayments as $payment)
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <h3 class="text-sm font-medium text-red-800">{{ ucwords(str_replace('_', ' ', $payment->payment_type)) }}</h3>
                                        <p class="text-sm text-red-600 mt-1">{{ __('messages.amount') }}: {{ number_format($payment->amount) }} FCFA</p>
                                        <p class="text-xs text-red-500 mt-1">{{ __('messages.due') }}: {{ $payment->due_date->format('M d, Y') }}</p>
                                        @if($payment->reference_number)
                                            <p class="text-xs text-gray-500 mt-1">{{ __('messages.ref') }}: {{ $payment->reference_number }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-3 sm:mt-0">
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-medium">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        <p>Please visit the gym to complete your payment(s).</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
            <a href="{{ route('progress') }}" class="bg-white rounded-lg shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="text-center">
                    <div class="bg-blue-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-2">Track Progress</h3>
                    <p class="text-xs sm:text-sm text-gray-600">Log workouts and measurements</p>
                </div>
            </a>
            
            <a href="{{ route('goals') }}" class="bg-white rounded-lg shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="text-center">
                    <div class="bg-green-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-2">Set Goals</h3>
                    <p class="text-xs sm:text-sm text-gray-600">Create and manage fitness goals</p>
                </div>
            </a>
            
            <a href="{{ route('services') }}" class="bg-white rounded-lg shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
                <div class="text-center">
                    <div class="bg-purple-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-2">Services</h3>
                    <p class="text-xs sm:text-sm text-gray-600">Book additional services</p>
                </div>
            </a>
            
            @if($membership && $membership->status === 'active')
                <a href="{{ route('membership.card') }}" class="bg-white rounded-lg shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="text-center">
                        <div class="bg-yellow-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-2">Membership Card</h3>
                        <p class="text-xs sm:text-sm text-gray-600">View digital card</p>
                    </div>
                </a>
            @endif
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
            <!-- Recent Progress -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900">Recent Progress</h2>
                        <a href="{{ route('progress') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    @if($recentProgressLogs->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentProgressLogs as $log)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if($log->current_weight)
                                                <p class="text-sm font-medium text-gray-900">Weight: {{ $log->current_weight }} kg</p>
                                            @endif
                                            @if($log->notes)
                                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($log->notes, 50) }}</p>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $log->logged_at ? $log->logged_at->diffForHumans() : $log->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="text-gray-500 mb-2">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">No progress logged yet</p>
                            <a href="{{ route('progress') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Start Tracking</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Active Goals -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900">Active Goals</h2>
                        <a href="{{ route('goals') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    @if($activeGoals->count() > 0)
                        <div class="space-y-4">
                            @foreach($activeGoals->take(3) as $goal)
                                <div class="border-l-4 border-green-500 pl-4 py-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">{{ $goal->title }}</p>
                                            <div class="mt-1">
                                                <div class="bg-gray-200 rounded-full h-2 w-full">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $goal->getProgressPercentage() }}%"></div>
                                                </div>
                                                <p class="text-xs text-gray-600 mt-1">{{ $goal->current_value }}/{{ $goal->target_value }} {{ $goal->unit }} ({{ number_format($goal->getProgressPercentage(), 1) }}%)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-6">
                            <div class="text-gray-500 mb-2">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">{{ __('messages.no_active_goals') }}</p>
                            <a href="{{ route('goals') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">{{ __('messages.set_your_first_goal') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- My Services -->
        @if($services->count() > 0)
            <div class="bg-white rounded-lg shadow-lg mt-8">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-900">{{ __('messages.my_selected_services') }}</h2>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($services as $service)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-medium text-gray-900 mb-2">{{ $service->translated_name }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($service->translated_description, 80) }}</p>
                                @if($service->price)
                                    <p class="text-sm font-medium text-blue-600">{{ number_format($service->price) }} FCFA</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection 