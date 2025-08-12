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
                width: 320px !important;
                height: 200px !important;
                min-width: 320px !important;
                min-height: 200px !important;
                max-width: 320px !important;
                max-height: 200px !important;
            }
            .no-print {
                display: none !important;
            }
        }
        
        /* Card container with fixed dimensions for download */
        .membership-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            width: 320px;
            height: 200px;
            min-width: 320px;
            min-height: 200px;
            max-width: 320px;
            max-height: 200px;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0,0,0,0.10);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: stretch;
            box-sizing: border-box;
        }
        
        /* Responsive adjustments for mobile display only */
        @media (max-width: 700px) {
            .membership-card {
                width: 100% !important;
                min-width: 0 !important;
                height: auto !important;
                padding: 0.25rem !important;
                max-width: 100vw !important;
                max-height: none !important;
            }
        }
        
        /* Ensure all card elements use border-box */
        .membership-card * {
            box-sizing: border-box;
        }
        
        /* Card background pattern */
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
        
        /* QR code styling */
        .qr-code {
            background: white;
            padding: 6px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            flex-shrink: 0;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Card shine effect */
        .card-shine {
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.3) 50%, transparent 70%);
            animation: shine 3s infinite;
        }
        
        /* Animations */
        @keyframes drift {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes shine {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }
        
        /* Card content layout */
        .card-content {
            position: relative;
            z-index: 10;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 8px;
        }
        
        /* Card header */
        .card-header {
            flex-shrink: 0;
            margin-bottom: 4px;
        }
        
        /* Card body */
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin: 4px 0;
        }
        
        /* Card footer */
        .card-footer {
            flex-shrink: 0;
            border-top: 1px solid rgba(255,255,255,0.2);
            padding-top: 6px;
            margin-top: 4px;
        }
        
        /* Grid layout for card info */
        .card-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            width: 100%;
        }
        
        /* Text truncation */
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Download-specific styles */
        .download-mode .membership-card {
            width: 320px !important;
            height: 200px !important;
            min-width: 320px !important;
            min-height: 200px !important;
            max-width: 320px !important;
            max-height: 200px !important;
        }
        
        .download-mode .membership-card .card-content {
            padding: 8px !important;
        }
        
        .download-mode .membership-card .card-header {
            margin-bottom: 4px !important;
        }
        
        .download-mode .membership-card .card-body {
            margin: 4px 0 !important;
        }
        
        .download-mode .membership-card .card-footer {
            margin-top: 4px !important;
            padding-top: 6px !important;
        }
        
        .download-mode .membership-card .qr-code {
            width: 36px !important;
            height: 36px !important;
            padding: 6px !important;
        }
        
        /* Ensure text fits properly in download mode */
        .download-mode .membership-card h1 {
            font-size: 16px !important;
            line-height: 1.2 !important;
        }
        
        .download-mode .membership-card h2 {
            font-size: 16px !important;
            line-height: 1.2 !important;
        }
        
        .download-mode .membership-card .card-info-grid p {
            font-size: 10px !important;
            line-height: 1.1 !important;
        }
        
        .download-mode .membership-card .card-footer p {
            font-size: 10px !important;
            line-height: 1.1 !important;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">
    
    <!-- Action Buttons -->
    <div class="no-print w-full flex flex-col sm:flex-row gap-2 mb-6 items-center justify-center">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 w-full sm:w-auto">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
            </svg>
            Print Card
        </button>
        <button onclick="downloadCard()" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-green-700 transition duration-300 w-full sm:w-auto">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Download PNG
        </button>
        <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-gray-700 transition duration-300 inline-block w-full sm:w-auto">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>

    <!-- Responsive Layout: Card above, info below on mobile; side by side on desktop -->
    <div class="w-full flex flex-col lg:flex-row items-center justify-center gap-8 mt-8">
        <!-- Membership Card Container -->
        <div class="membership-card relative mb-6 lg:mb-0" id="membership-card">
            <!-- Animated Background Pattern -->
            <div class="absolute inset-0">
                <div class="card-shine absolute inset-0"></div>
            </div>
            
            <!-- Card Content -->
            <div class="card-content">
                <!-- Header -->
                <div class="card-header">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-white text-lg font-bold leading-tight">FitLife Gym</h1>
                            <p class="text-blue-100 text-xs leading-tight">Membership Card</p>
                        </div>
                        <div class="qr-code">
                            {!! QrCode::size(28)->generate(route('membership.verify', ['card' => $membership->card_number])) !!}
                        </div>
                    </div>
                </div>
                
                <!-- Member Info -->
                <div class="card-body">
                    <div class="mb-3">
                        <h2 class="text-white text-lg font-bold leading-tight">{{ $user->name }}</h2>
                        <p class="text-blue-200 text-xs leading-tight">{{ $user->email }}</p>
                    </div>
                    <div class="card-info-grid">
                        <div>
                            <p class="text-blue-200 text-[10px]">{{ __('messages.card_number') }}</p>
                            <p class="text-white font-mono font-bold text-[10px] leading-tight">{{ $membership->card_number }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-[10px]">{{ __('messages.package') }}</p>
                            <p class="text-white font-semibold text-[10px] leading-tight">{{ $membership->package->name }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-[10px]">{{ __('messages.valid_from') }}</p>
                            <p class="text-white text-[10px] leading-tight">{{ $membership->start_date->format('M j, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-[10px]">{{ __('messages.expires') }}</p>
                            <p class="text-white text-[10px] leading-tight">{{ $membership->end_date->format('M j, Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="card-footer">
                    <div class="flex justify-between items-center">
                        <div class="text-blue-200 text-[10px]">
                            {{ __('messages.status') }}: <span class="text-white font-semibold">{{ strtoupper($membership->status) }}</span>
                        </div>
                        <div class="text-blue-200 text-[10px]">
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
        <div class="no-print w-full max-w-md bg-white rounded-lg shadow-lg p-6">
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
    </div>

    <script>
        function downloadCard() {
            // Add download mode class to ensure proper sizing
            document.body.classList.add('download-mode');
            
            // Wait a moment for CSS to apply
            setTimeout(() => {
                // Create a canvas to capture the card
                html2canvas(document.getElementById('membership-card'), {
                    width: 320,
                    height: 200,
                    scale: 2, // Higher resolution
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: null,
                    logging: false,
                    removeContainer: true
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'membership-card-{{ $user->name }}.png';
                    link.href = canvas.toDataURL('image/png', 1.0);
                    link.click();
                    
                    // Remove download mode class
                    document.body.classList.remove('download-mode');
                }).catch(error => {
                    console.error('Error generating card:', error);
                    document.body.classList.remove('download-mode');
                });
            }, 150);
        }
        
        // Load html2canvas library
        const script = document.createElement('script');
        script.src = 'https://html2canvas.hertzen.com/dist/html2canvas.min.js';
        document.head.appendChild(script);
    </script>
</body>
</html> 