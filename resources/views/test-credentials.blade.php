@extends('layout')

@section('title', 'Test Credentials - FitLife Gym')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Test Login Credentials</h1>
            <p class="text-gray-600">Use these credentials to test different user roles in the system</p>
        </div>

        <!-- Admin & Staff Credentials -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 9-1.332 9-6.03 9-11.622 0-3.042-.735-5.918-2.382-8.016z"></path>
                    </svg>
                    Administrative Access
                </h2>
            </div>
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Admin -->
                    <div class="bg-red-50 p-4 rounded-lg border border-red-100">
                        <h3 class="font-semibold text-red-900 mb-2">System Admin</h3>
                        <div class="space-y-1 text-sm">
                            <p><span class="font-medium">Email:</span> admin@fitlifegym.com</p>
                            <p><span class="font-medium">Password:</span> password</p>
                            <p class="text-red-600 text-xs">Full system access</p>
                        </div>
                    </div>

                    <!-- Manager -->
                    <div class="bg-orange-50 p-4 rounded-lg border border-orange-100">
                        <h3 class="font-semibold text-orange-900 mb-2">Gym Manager</h3>
                        <div class="space-y-1 text-sm">
                            <p><span class="font-medium">Email:</span> manager@fitlifegym.com</p>
                            <p><span class="font-medium">Password:</span> password</p>
                            <p class="text-orange-600 text-xs">Manage members & approvals</p>
                        </div>
                    </div>

                    <!-- Instructor -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <h3 class="font-semibold text-blue-900 mb-2">Gym Instructor</h3>
                        <div class="space-y-1 text-sm">
                            <p class="text-blue-600 text-xs">Use any instructor email from the list below</p>
                            <p><span class="font-medium">Password:</span> password</p>
                            <p class="text-blue-600 text-xs">View assigned members</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Member Credentials -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Member Access
                </h2>
                <p class="text-gray-600 text-sm mt-1">All member accounts use <span class="font-mono bg-gray-100 px-2 py-1 rounded">password</span> as the password</p>
            </div>
            <div class="px-6 py-4">
                <!-- Sample Member Accounts -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <h3 class="font-semibold text-green-900 mb-2">Custom Member Account</h3>
                        <div class="space-y-1 text-sm">
                            <p><span class="font-medium">Email:</span> diranengala@gmail.com</p>
                            <p><span class="font-medium">Password:</span> password</p>
                            <p class="text-green-600 text-xs">Active membership</p>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                        <h3 class="font-semibold text-green-900 mb-2">Active Member Sample</h3>
                        <div class="space-y-1 text-sm">
                            <p><span class="font-medium">Email:</span> stark.candice@example.net</p>
                            <p><span class="font-medium">Password:</span> password</p>
                            <p class="text-green-600 text-xs">Active membership with services</p>
                        </div>
                    </div>
                </div>

                <!-- Other Member Emails -->
                <div class="border-t border-gray-200 pt-4">
                    <h4 class="font-medium text-gray-900 mb-3">Other Available Member Accounts:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                        <div class="text-sm bg-gray-50 p-2 rounded">
                            <code class="text-xs">oruecker@example.org</code>
                        </div>
                        <div class="text-sm bg-gray-50 p-2 rounded">
                            <code class="text-xs">olson.tamara@example.com</code>
                        </div>
                        <div class="text-sm bg-gray-50 p-2 rounded">
                            <code class="text-xs">amparo.waelchi@example.org</code>
                        </div>
                        <div class="text-sm bg-gray-50 p-2 rounded">
                            <code class="text-xs">demarco.daniel@example.net</code>
                        </div>
                        <div class="text-sm bg-gray-50 p-2 rounded">
                            <code class="text-xs">mosinski@example.org</code>
                        </div>
                        <div class="text-sm bg-gray-50 p-2 rounded">
                            <code class="text-xs">xmurazik@example.org</code>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">...and 20+ more member accounts available</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Quick Actions</h2>
            </div>
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login Page
                    </a>

                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register New Member
                    </a>

                    <a href="/admin" class="flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Admin Panel
                    </a>
                </div>
            </div>
        </div>

        <!-- Instructions -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-3">Testing Instructions</h3>
            <div class="space-y-2 text-blue-800">
                <p><strong>1. Members:</strong> Login with any member email to access the dashboard, view membership status, track progress, and manage goals.</p>
                <p><strong>2. Admins/Managers:</strong> Login to access the Filament admin panel for membership approvals, payment management, and system administration.</p>
                <p><strong>3. Registration:</strong> Try registering a new member to test the approval workflow.</p>
                <p><strong>4. Mobile:</strong> Test on mobile devices - the interface is fully responsive.</p>
            </div>
        </div>
    </div>
</div>
@endsection 