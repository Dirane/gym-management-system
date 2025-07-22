@extends('layout')

@section('title', 'Join FitLife Gym - Member Registration')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">Join FitLife Gym</h1>
        <p class="text-lg sm:text-xl max-w-3xl mx-auto">
            Start your fitness journey today! Choose a membership package and become part of our community.
        </p>
    </div>
</section>

<!-- Registration Form -->
<section class="py-12 sm:py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-8 sm:px-10 sm:py-10">
                <div class="text-center mb-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Create Your Account</h2>
                    <p class="text-gray-600 mt-2">Fill out the form below to become a member</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-red-700">
                                <p class="font-medium">Please correct the following errors:</p>
                                <ul class="mt-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <div class="text-sm text-green-700">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    
                    <!-- Personal Information -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.email_address') }} *</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.date_of_birth') }} *</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('date_of_birth') border-red-500 @enderror">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea id="address" name="address" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('address') border-red-500 @enderror"
                                placeholder="Enter your complete address">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Emergency Contact</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Name</label>
                                <input type="text" id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('emergency_contact') border-red-500 @enderror">
                                @error('emergency_contact')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="emergency_phone" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Phone</label>
                                <input type="tel" id="emergency_phone" name="emergency_phone" value="{{ old('emergency_phone') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('emergency_phone') border-red-500 @enderror">
                                @error('emergency_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Medical Information -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Medical Information</h3>
                        <div>
                            <label for="medical_conditions" class="block text-sm font-medium text-gray-700 mb-2">Medical Conditions or Allergies</label>
                            <textarea id="medical_conditions" name="medical_conditions" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('medical_conditions') border-red-500 @enderror"
                                placeholder="Please list any medical conditions, injuries, or allergies we should be aware of">{{ old('medical_conditions') }}</textarea>
                            @error('medical_conditions')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Account Security</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.password') }} *</label>
                                <input type="password" id="password" name="password" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters long</p>
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.confirm_password') }} *</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            </div>
                        </div>
                    </div>

                    <!-- Membership Package -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('messages.choose_your_membership_package') }}</h3>
                        
                        @if($packages->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($packages as $package)
                                <div class="relative">
                                    <input type="radio" id="package_{{ $package->id }}" name="package_id" value="{{ $package->id }}" 
                                        {{ old('package_id') == $package->id ? 'checked' : '' }}
                                        class="sr-only peer" required>
                                    <label for="package_{{ $package->id }}" 
                                        class="block p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-colors">
                                        <div class="text-lg font-semibold text-gray-900 mb-2">{{ $package->translated_name }}</div>
                                        <div class="text-2xl font-bold text-blue-600 mb-2">
                                            {{ number_format($package->price) }} FCFA
                                            <span class="text-sm font-normal text-gray-500">/ {{ $package->duration_months }} {{ $package->duration_months > 1 ? __('messages.months') : __('messages.month') }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($package->translated_description, 100) }}</p>
                                        @if($package->features && count($package->features) > 0)
                                            <ul class="text-xs text-gray-500 space-y-1">
                                                @foreach(array_slice($package->translated_features, 0, 3) as $feature)
                                                    <li class="flex items-center">
                                                        <svg class="w-3 h-3 text-green-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $feature }}
                                                    </li>
                                                @endforeach
                                                @if(count($package->translated_features) > 3)
                                                    <li class="text-xs text-blue-600">{{ __('messages.plus_more', ['count' => count($package->translated_features) - 3]) }}</li>
                                                @endif
                                            </ul>
                                        @endif
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @error('package_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        @else
                            <p class="text-gray-600">{{ __('messages.no_packages_available') }}</p>
                        @endif
                    </div>

                    <!-- Additional Services (Optional) -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Services <span class="text-sm font-normal text-gray-500">(Optional)</span></h3>
                        <p class="text-sm text-gray-600 mb-4">Select additional services you're interested in. These can be added to your membership package.</p>
                        
                        @if(isset($services) && $services->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach($services as $service)
                                <div class="relative">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" id="service_{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <label for="service_{{ $service->id }}" class="block text-sm font-medium text-gray-700 cursor-pointer">
                                                <div class="flex justify-between items-start">
                                                    <div class="flex-1">
                                                        <div class="font-semibold">{{ $service->translated_name }}</div>
                                                        <p class="text-xs text-gray-600 mt-1">{{ Str::limit($service->translated_description, 80) }}</p>
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            @if($service->duration_minutes)
                                                                {{ $service->duration_minutes }} {{ __('messages.min') }}
                                                            @endif
                                                            @if($service->max_participants)
                                                                • {{ __('messages.max') }} {{ $service->max_participants }} {{ $service->max_participants == 1 ? __('messages.person') : __('messages.people') }}
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @if($service->price)
                                                        <div class="text-sm font-semibold text-blue-600 ml-2">
                                                            {{ number_format($service->price) }} FCFA
                                                        </div>
                                                    @endif
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No additional services available at the moment.</p>
                        @endif
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="pb-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" value="1" {{ old('terms') ? 'checked' : '' }} required
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-700">
                                    I agree to the <a href="#" class="text-blue-600 hover:text-blue-800 underline">Terms and Conditions</a> 
                                    and <a href="#" class="text-blue-600 hover:text-blue-800 underline">Privacy Policy</a> *
                                </label>
                                @error('terms')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                            Complete Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Why Join FitLife Gym?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Join thousands of satisfied members who have transformed their lives with us.
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Expert Guidance</h3>
                <p class="text-gray-600 text-sm">Professional trainers to guide your fitness journey</p>
            </div>
            
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Community</h3>
                <p class="text-gray-600 text-sm">Join a supportive community of fitness enthusiasts</p>
            </div>
            
            <div class="text-center p-6 bg-gray-50 rounded-lg">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Track Progress</h3>
                <p class="text-gray-600 text-sm">Monitor your fitness journey with detailed tracking</p>
            </div>
        </div>
    </div>
</section>
@endsection 