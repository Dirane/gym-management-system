@extends('layout')

@section('title', 'Progress Tracking - FitLife Gym')

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">Track Your Progress</h1>
            <p class="text-blue-100 text-sm sm:text-base">Log your workouts and monitor your fitness journey</p>
        </div>
    </div>
</section>

<!-- Progress Content -->
<section class="py-8 sm:py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back to Dashboard -->
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <!-- Add Progress Log Form -->
        <div class="bg-white rounded-lg shadow-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900">Log New Progress</h2>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <form method="POST" action="{{ route('progress.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Goal Selection -->
                        <div class="sm:col-span-2 lg:col-span-3">
                            <label for="goal_id" class="block text-sm font-medium text-gray-700 mb-2">Related Goal (Optional)</label>
                            <select id="goal_id" name="goal_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select a goal...</option>
                                @foreach($goals as $goal)
                                    <option value="{{ $goal->id }}" {{ old('goal_id') == $goal->id ? 'selected' : '' }}>
                                        {{ $goal->title }} ({{ $goal->current_value }}/{{ $goal->target_value }} {{ $goal->unit }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Weight -->
                        <div>
                            <label for="current_weight" class="block text-sm font-medium text-gray-700 mb-2">Current Weight (kg)</label>
                            <input type="number" step="0.1" id="current_weight" name="current_weight" value="{{ old('current_weight') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('current_weight') border-red-500 @enderror">
                            @error('current_weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Body Fat -->
                        <div>
                            <label for="body_fat_percentage" class="block text-sm font-medium text-gray-700 mb-2">Body Fat (%)</label>
                            <input type="number" step="0.1" id="body_fat_percentage" name="body_fat_percentage" value="{{ old('body_fat_percentage') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('body_fat_percentage') border-red-500 @enderror">
                            @error('body_fat_percentage')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Muscle Mass -->
                        <div>
                            <label for="muscle_mass" class="block text-sm font-medium text-gray-700 mb-2">Muscle Mass (kg)</label>
                            <input type="number" step="0.1" id="muscle_mass" name="muscle_mass" value="{{ old('muscle_mass') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('muscle_mass') border-red-500 @enderror">
                            @error('muscle_mass')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea id="notes" name="notes" rows="3" placeholder="How did today's workout go? Any achievements or challenges?"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Progress Photo -->
                    <div>
                        <label for="progress_photo" class="block text-sm font-medium text-gray-700 mb-2">Progress Photo (Optional)</label>
                        <input type="file" id="progress_photo" name="progress_photo" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('progress_photo') border-red-500 @enderror">
                        @error('progress_photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Max file size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</p>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200">
                            Log Progress
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Progress History -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900">Progress History</h2>
            </div>
            <div class="px-4 py-5 sm:px-6">
                @if($progressLogs->count() > 0)
                    <div class="space-y-6">
                        @foreach($progressLogs as $log)
                            <div class="bg-gray-50 rounded-lg p-4 sm:p-6">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $log->date }}
                                        </h3>
                                        <p class="text-sm text-gray-500">{{ $log->created_at->format('g:i A') }}</p>
                                    </div>
                                    @if($log->goal)
                                        <div class="mt-2 sm:mt-0">
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">
                                                {{ $log->goal->title }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Measurements -->
                                @if($log->weight || $log->body_fat_percentage || $log->muscle_mass)
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                                        @if($log->weight)
                                            <div class="text-center p-3 bg-white rounded-lg">
                                                <div class="text-2xl font-bold text-blue-600">{{ $log->weight }}</div>
                                                <div class="text-sm text-gray-600">Weight (kg)</div>
                                            </div>
                                        @endif
                                        
                                        @if($log->body_fat_percentage)
                                            <div class="text-center p-3 bg-white rounded-lg">
                                                <div class="text-2xl font-bold text-green-600">{{ $log->body_fat_percentage }}%</div>
                                                <div class="text-sm text-gray-600">Body Fat</div>
                                            </div>
                                        @endif
                                        
                                        @if($log->muscle_mass)
                                            <div class="text-center p-3 bg-white rounded-lg">
                                                <div class="text-2xl font-bold text-purple-600">{{ $log->muscle_mass }}</div>
                                                <div class="text-sm text-gray-600">Muscle Mass (kg)</div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                
                                <!-- Notes -->
                                @if($log->notes)
                                    <div class="mb-4">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Notes:</h4>
                                        <p class="text-sm text-gray-600 bg-white p-3 rounded-lg">{{ $log->notes }}</p>
                                    </div>
                                @endif
                                
                                <!-- Progress Photo -->
                                @if($log->photos)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Progress Photos:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($log->photos as $photo)
                                                <div class="max-w-xs">
                                                    <img src="{{ Storage::url($photo) }}" alt="Progress photo from {{ $log->date }}" 
                                                        class="w-full h-auto rounded-lg shadow-md">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $progressLogs->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="text-gray-500 mb-4">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Progress Logged Yet</h3>
                        <p class="text-gray-600">Start tracking your fitness journey by logging your first progress entry above.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection 