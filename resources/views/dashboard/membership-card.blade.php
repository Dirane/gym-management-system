<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Card - {{ $user->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .membership-card, .membership-card * {
                visibility: visible;
            }
            .membership-card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
            }
            .no-print {
                display: none !important;
            }
        }
        
        .membership-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            width: 400px;
            height: 250px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .membership-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23pattern)"/></svg>');
            animation: drift 20s linear infinite;
        }
        
        @keyframes drift {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .qr-code {
            background: white;
            padding: 8px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .card-shine {
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    
    <!-- Action Buttons -->
    <div class="no-print fixed top-4 right-4 space-x-2 z-50">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print Card
        </button>
        <button onclick="downloadCard()" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-green-700 transition duration-300">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Download PNG
        </button>
        <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-700 transition duration-300 inline-block">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>

    <!-- Membership Card Container -->
    <div class="membership-card mx-auto relative" id="membership-card">
        <!-- Animated Background Pattern -->
        <div class="absolute inset-0">
            <div class="card-shine absolute inset-0"></div>
        </div>
        
        <!-- Card Content -->
        <div class="relative z-10 h-full flex flex-col">
            <!-- Header -->
            <div class="flex justify-between items-start p-6 pb-2">
                <div>
                    <h1 class="text-white text-xl font-bold">FitLife Gym</h1>
                    <p class="text-blue-100 text-sm">Membership Card</p>
                </div>
                <div class="qr-code">
                    {!! QrCode::size(60)->generate(route('membership.verify', ['card' => $membership->card_number])) !!}
                </div>
            </div>
            
            <!-- Member Info -->
            <div class="flex-1 px-6 py-2">
                <div class="mb-3">
                    <h2 class="text-white text-2xl font-bold">{{ $user->name }}</h2>
                    <p class="text-blue-200 text-sm">{{ $user->email }}</p>
                </div>
                
                                 <div class="grid grid-cols-2 gap-3 text-xs">
                     <div>
                         <p class="text-blue-200">{{ __('messages.card_number') }}</p>
                         <p class="text-white font-mono font-bold text-sm">{{ $membership->card_number }}</p>
                     </div>
                     <div>
                         <p class="text-blue-200">{{ __('messages.package') }}</p>
                         <p class="text-white font-semibold text-sm">{{ $membership->package->name }}</p>
                     </div>
                     <div>
                         <p class="text-blue-200">{{ __('messages.valid_from') }}</p>
                         <p class="text-white text-xs">{{ $membership->start_date->format('M j, Y') }}</p>
                     </div>
                     <div>
                         <p class="text-blue-200">{{ __('messages.expires') }}</p>
                         <p class="text-white text-xs">{{ $membership->end_date->format('M j, Y') }}</p>
                     </div>
                 </div>
            </div>
            
            <!-- Footer -->
            <div class="px-6 py-4 border-t border-white/20">
                <div class="flex justify-between items-center text-xs">
                    <div class="text-blue-200">
                        {{ __('messages.status') }}: <span class="text-white font-semibold">{{ strtoupper($membership->status) }}</span>
                    </div>
                    <div class="text-blue-200">
                        {{ __('messages.member_id') }}: <span class="text-white font-mono">{{ str_pad($user->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-4 right-4 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
        <div class="absolute bottom-4 left-4 w-16 h-16 bg-white/5 rounded-full blur-lg"></div>
    </div>

    <!-- Card Information -->
    <div class="no-print mt-8 max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('messages.card_information') }}</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-600">{{ __('messages.member_since') }}:</span>
                <span class="font-medium">{{ $membership->start_date->format('F Y') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">{{ __('messages.membership_type') }}:</span>
                <span class="font-medium">{{ $membership->package->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">{{ __('messages.renewal_date') }}:</span>
                <span class="font-medium {{ $membership->end_date > now() ? 'text-green-600' : 'text-red-600' }}">
                    {{ $membership->end_date->format('M d, Y') }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">{{ __('messages.qr_code') }}:</span>
                <span class="font-medium text-blue-600">{{ __('messages.scan_for_verification') }}</span>
            </div>
        </div>
        
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <h4 class="font-semibold text-blue-900 mb-2">{{ __('messages.instructions') }}</h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• {{ __('messages.present_this_card') }}</li>
                <li>• {{ __('messages.qr_code_scan') }}</li>
                <li>• {{ __('messages.keep_card_safe') }}</li>
                <li>• {{ __('messages.valid_when_active') }}</li>
            </ul>
        </div>
    </div>

    <script>
        function downloadCard() {
            // Create a canvas to capture the card
            html2canvas(document.getElementById('membership-card')).then(canvas => {
                const link = document.createElement('a');
                link.download = 'membership-card-{{ $user->name }}.png';
                link.href = canvas.toDataURL();
                link.click();
            });
        }
        
        // Load html2canvas library
        const script = document.createElement('script');
        script.src = 'https://html2canvas.hertzen.com/dist/html2canvas.min.js';
        document.head.appendChild(script);
    </script>
</body>
</html> 