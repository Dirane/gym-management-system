@extends('layout')

@section('title', __('messages.goals') . ' - ' . __('messages.fitlife_gym'))

@section('content')
<!-- Header -->
<section class="bg-gradient-to-r from-green-600 to-blue-700 text-white py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">Fitness Goals</h1>
                <p class="text-green-100 text-sm sm:text-base">Set, track, and achieve your fitness objectives</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('dashboard') }}" class="bg-white text-green-600 px-4 py-2 sm:px-6 sm:py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 text-sm sm:text-base">
                    ← Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Goals Management -->
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

        <!-- Create Goal Form -->
        <div class="bg-white rounded-lg shadow-lg mb-8">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900">{{ __('messages.create_new_goal') }}</h2>
            </div>
            <div class="px-4 py-5 sm:px-6">
                <form method="POST" action="{{ route('goals.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.goal_title') }} *</label>
                            <input type="text" id="title" name="title" required value="{{ old('title') }}"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('title') border-red-500 @enderror"
                                placeholder="{{ __('messages.goal_title_placeholder') }}">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.unit') }} *</label>
                            <select id="unit" name="unit" required
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('unit') border-red-500 @enderror">
                                <option value="">{{ __('messages.select_unit') }}</option>
                                <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>{{ __('messages.kilograms') }}</option>
                                <option value="lbs" {{ old('unit') == 'lbs' ? 'selected' : '' }}>{{ __('messages.pounds') }}</option>
                                <option value="km" {{ old('unit') == 'km' ? 'selected' : '' }}>{{ __('messages.kilometers') }}</option>
                                <option value="miles" {{ old('unit') == 'miles' ? 'selected' : '' }}>{{ __('messages.miles') }}</option>
                                <option value="minutes" {{ old('unit') == 'minutes' ? 'selected' : '' }}>{{ __('messages.minutes') }}</option>
                                <option value="reps" {{ old('unit') == 'reps' ? 'selected' : '' }}>{{ __('messages.repetitions') }}</option>
                                <option value="sets" {{ old('unit') == 'sets' ? 'selected' : '' }}>{{ __('messages.sets') }}</option>
                                <option value="days" {{ old('unit') == 'days' ? 'selected' : '' }}>{{ __('messages.days') }}</option>
                                <option value="%" {{ old('unit') == '%' ? 'selected' : '' }}>{{ __('messages.percentage') }}</option>
                            </select>
                            @error('unit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="target_value" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.target_value') }} *</label>
                            <input type="number" id="target_value" name="target_value" required step="0.01" value="{{ old('target_value') }}"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('target_value') border-red-500 @enderror"
                                placeholder="e.g., 70, 100, 5">
                            @error('target_value')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="current_value" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.current_value') }}</label>
                            <input type="number" id="current_value" name="current_value" step="0.01" value="{{ old('current_value') }}"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('current_value') border-red-500 @enderror"
                                placeholder="{{ __('messages.current_value_placeholder') }}">
                            @error('current_value')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="target_date" class="block text-sm font-medium text-gray-700 mb-2">Target Date *</label>
                            <input type="date" id="target_date" name="target_date" required value="{{ old('target_date') }}"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('target_date') border-red-500 @enderror">
                            @error('target_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="before_photo" class="block text-sm font-medium text-gray-700 mb-2">Before Photo (Optional)</label>
                            <input type="file" id="before_photo" name="before_photo" accept="image/*"
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('before_photo') border-red-500 @enderror">
                            <p class="text-xs text-gray-500 mt-1">Upload a photo to track visual progress</p>
                            @error('before_photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.description') }}</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror"
                            placeholder="{{ __('messages.description_placeholder') }}">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-300">
                            {{ __('messages.create_goal') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Goals List -->
        @if($goals && $goals->count() > 0)
            <div class="space-y-6">
                @foreach($goals as $goal)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h3 class="text-lg font-bold text-gray-900 mr-3">{{ $goal->title }}</h3>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full
                                            {{ $goal->status === 'active' ? 'bg-green-100 text-green-800' : 
                                               ($goal->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($goal->status) }}
                                        </span>
                                    </div>
                                    
                                    @if($goal->description)
                                        <p class="text-gray-600 mb-4">{{ $goal->description }}</p>
                                    @endif

                                    <!-- Progress Bar -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700">Progress</span>
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ $goal->current_value }}/{{ $goal->target_value }} {{ $goal->unit }}
                                                ({{ number_format($goal->getProgressPercentage(), 1) }}%)
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3">
                                            <div class="h-3 rounded-full transition-all duration-300
                                                {{ $goal->getProgressPercentage() >= 100 ? 'bg-green-500' : 
                                                   ($goal->getProgressPercentage() >= 75 ? 'bg-blue-500' : 
                                                   ($goal->getProgressPercentage() >= 50 ? 'bg-yellow-500' : 'bg-red-500')) }}"
                                                style="width: {{ min($goal->getProgressPercentage(), 100) }}%">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Goal Details -->
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <span class="text-gray-500">Target Date</span>
                                            <p class="font-medium {{ $goal->target_date < now() ? 'text-red-600' : 'text-gray-900' }}">
                                                {{ $goal->target_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Days Left</span>
                                            <p class="font-medium {{ $goal->target_date->diffInDays(now(), false) < 0 ? 'text-red-600' : 'text-gray-900' }}">
                                                {{ $goal->target_date > now() ? $goal->target_date->diffInDays(now()) . ' days' : 'Overdue' }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Created</span>
                                            <p class="font-medium text-gray-900">{{ $goal->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Last Updated</span>
                                            <p class="font-medium text-gray-900">{{ $goal->updated_at ? $goal->updated_at->diffForHumans() : 'Never' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Goal Actions -->
                                @if($goal->status === 'active')
                                    <div class="mt-4 sm:mt-0 sm:ml-6 flex space-x-2">
                                        <button onclick="openUpdateModal({{ $goal->id }}, {{ $goal->current_value }}, {{ $goal->target_value }})" 
                                            class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-300">
                                            Update Progress
                                        </button>
                                        @if($goal->getProgressPercentage() >= 100)
                                            <form method="POST" action="{{ route('goals.update', $goal) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition duration-300">
                                                    Mark Complete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Before Photo -->
                            @if($goal->before_photo)
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <h4 class="text-sm font-medium text-gray-700 mb-2">Before Photo</h4>
                                    <img src="{{ Storage::url($goal->before_photo) }}" alt="Before photo" 
                                        class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                <div class="text-gray-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Goals Yet</h3>
                <p class="text-gray-600 mb-6">Start your fitness journey by setting your first goal!</p>
            </div>
        @endif
    </div>
</section>

<!-- Update Progress Modal -->
<div id="updateModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Progress</h3>
            <form id="updateForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="modal_current_value" class="block text-sm font-medium text-gray-700 mb-2">Current Value</label>
                    <input type="number" id="modal_current_value" name="current_value" step="0.01" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeUpdateModal()" 
                        class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openUpdateModal(goalId, currentValue, targetValue) {
    document.getElementById('modal_current_value').value = currentValue;
    document.getElementById('updateForm').action = `/goals/${goalId}`;
    document.getElementById('updateModal').classList.remove('hidden');
}

function closeUpdateModal() {
    document.getElementById('updateModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('updateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUpdateModal();
    }
});
</script>
@endsection 