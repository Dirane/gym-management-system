@extends('layout')

@section('title', __('messages.about_us') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-6">{{ __('messages.about_fitlife_gym') }}</h1>
        <p class="text-xl max-w-3xl mx-auto">
            {{ __('messages.empowering_individuals') }}
        </p>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ __('messages.our_mission') }}</h2>
                <p class="text-lg text-gray-600 mb-6">
                    {{ __('messages.our_mission_desc') }}
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600 mb-2">3+</div>
                        <div class="text-gray-600">{{ __('messages.years_serving') }}</div>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600 mb-2">500+</div>
                        <div class="text-gray-600">{{ __('messages.members') }}</div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 h-80 rounded-lg flex items-center justify-center">
                <span class="text-gray-500 text-lg">Gym Facility Image</span>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Core Values</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                These values guide everything we do and shape the experience we provide for our members.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="text-6xl mb-4">💪</div>
                <h3 class="text-2xl font-semibold mb-4">Excellence</h3>
                <p class="text-gray-600">
                    We strive for excellence in everything we do, from our equipment maintenance to our customer service, 
                    ensuring the highest quality experience for our members.
                </p>
            </div>
            
            <div class="text-center">
                <div class="text-6xl mb-4">🤝</div>
                <h3 class="text-2xl font-semibold mb-4">Community</h3>
                <p class="text-gray-600">
                    We foster a supportive community where members encourage each other, celebrate victories together, 
                    and build lasting friendships through shared fitness goals.
                </p>
            </div>
            
            <div class="text-center">
                <div class="text-6xl mb-4">🎯</div>
                <h3 class="text-2xl font-semibold mb-4">Results</h3>
                <p class="text-gray-600">
                    We are committed to helping our members achieve real, measurable results through proven training methods, 
                    nutrition guidance, and consistent support.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
            <p class="text-xl text-gray-600">
                Our certified trainers and staff are here to support you every step of the way.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-gray-200 w-32 h-32 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span class="text-4xl">👨‍💼</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">John Manager</h3>
                <p class="text-gray-600 mb-2">Gym Manager</p>
                <p class="text-sm text-gray-500">10+ years fitness industry experience</p>
            </div>
            
            <div class="text-center">
                <div class="bg-gray-200 w-32 h-32 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span class="text-4xl">👨‍🏫</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Mike Trainer</h3>
                <p class="text-gray-600 mb-2">Head Trainer</p>
                <p class="text-sm text-gray-500">Certified Personal Trainer, Nutrition Specialist</p>
            </div>
            
            <div class="text-center">
                <div class="bg-gray-200 w-32 h-32 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span class="text-4xl">👩‍🏫</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Sarah Coach</h3>
                <p class="text-gray-600 mb-2">Fitness Instructor</p>
                <p class="text-sm text-gray-500">Yoga & Pilates Certified, Group Fitness</p>
            </div>
            
            <div class="text-center">
                <div class="bg-gray-200 w-32 h-32 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <span class="text-4xl">👨‍🏫</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">David Strong</h3>
                <p class="text-gray-600 mb-2">Strength Coach</p>
                <p class="text-sm text-gray-500">Powerlifting Expert, Sports Performance</p>
            </div>
        </div>
    </div>
</section>

<!-- Facilities -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Facilities</h2>
            <p class="text-xl text-gray-600">
                State-of-the-art equipment and amenities designed for your comfort and success.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-4xl mb-4">🏋️</div>
                <h3 class="text-xl font-semibold mb-3">Weight Training Area</h3>
                <p class="text-gray-600">
                    Complete free weights section with barbells, dumbbells, and Olympic platforms for serious strength training.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-4xl mb-4">🚴</div>
                <h3 class="text-xl font-semibold mb-3">Cardio Zone</h3>
                <p class="text-gray-600">
                    Modern cardio equipment including treadmills, ellipticals, and stationary bikes with entertainment systems.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-4xl mb-4">🧘</div>
                <h3 class="text-xl font-semibold mb-3">Group Class Studio</h3>
                <p class="text-gray-600">
                    Spacious studio for yoga, pilates, zumba, and other group fitness classes with professional sound system.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-4xl mb-4">🚿</div>
                <h3 class="text-xl font-semibold mb-3">Locker Rooms</h3>
                <p class="text-gray-600">
                    Clean, spacious locker rooms with showers, changing areas, and secure storage for your belongings.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-4xl mb-4">🥤</div>
                <h3 class="text-xl font-semibold mb-3">Nutrition Bar</h3>
                <p class="text-gray-600">
                    Healthy snacks, protein shakes, and supplements to fuel your workouts and aid in recovery.
                </p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="text-4xl mb-4">🅿️</div>
                <h3 class="text-xl font-semibold mb-3">Free Parking</h3>
                <p class="text-gray-600">
                    Convenient, secure parking available for all members with easy access to the gym entrance.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Join Our Community?</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto">
            Experience the FitLife difference for yourself. Visit our facility for a tour or start your membership today.
        </p>
        <div class="space-x-4">
            <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-yellow-300 transition duration-300">
                Start Membership
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>
@endsection 