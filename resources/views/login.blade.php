@extends('layout')

@section('title', __('messages.login') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">{{ __('messages.welcome_back') }}</h1>
        <p class="text-lg sm:text-xl max-w-3xl mx-auto">
            {{ __('messages.login_description') }}
        </p>
    </div>
</section>

<!-- Login Form -->
<section class="py-12 sm:py-16 bg-gray-50">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-8 sm:px-8 sm:py-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ __('messages.login_to_account') }}</h2>
                    <p class="text-gray-600 mt-2">{{ __('messages.enter_credentials') }}</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-red-700">
                                <p class="font-medium">{{ __('messages.please_correct_errors') }}</p>
                                <ul class="mt-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div class="text-sm text-green-700">
                                {{ session('status') }}
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email_address') }}</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.password') }}</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="remember" class="ml-2 text-sm text-gray-700">{{ __('messages.remember_me') }}</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 underline">
                                {{ __('messages.forgot_password') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                        {{ __('messages.sign_in') }}
                    </button>

                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            {{ __('messages.dont_have_account') }} 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold underline">
                                {{ __('messages.register_here') }}
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Quick Links -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">{{ __('messages.new_to_fitlife') }}</h2>
            <p class="text-lg text-gray-600">
                {{ __('messages.join_community') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">{{ __('messages.easy_registration') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.easy_registration_desc') }}</p>
            </div>
            
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">{{ __('messages.expert_training') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.expert_training_desc') }}</p>
            </div>
            
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">{{ __('messages.track_progress') }}</h3>
                <p class="text-gray-600 text-sm">{{ __('messages.track_progress_desc') }}</p>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-300">
                {{ __('messages.start_your_journey') }}
            </a>
        </div>
    </div>
</section>
@endsection 