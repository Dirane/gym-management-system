<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-2xl mx-auto py-8 px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">FitLife Gym</h1>
            <p class="text-gray-600">Membership Verification System</p>
        </div>

        <div id="verification-result" class="bg-white rounded-lg shadow-lg p-6">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Verifying membership...</p>
            </div>
        </div>
    </div>

    <script>
        // Get card number from URL
        const urlPath = window.location.pathname;
        const cardNumber = urlPath.split('/').pop();
        
        // Verify membership
        fetch(`/api/membership/verify/${cardNumber}`)
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('verification-result');
                
                if (data.valid) {
                    resultDiv.innerHTML = `
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-green-600 mb-2">Valid Membership</h2>
                            <div class="space-y-2 text-gray-700">
                                <p><strong>Member:</strong> ${data.member_name}</p>
                                <p><strong>Package:</strong> ${data.package}</p>
                                <p><strong>Status:</strong> <span class="text-green-600 font-semibold">${data.status.charAt(0).toUpperCase() + data.status.slice(1)}</span></p>
                                <p><strong>Expires:</strong> ${new Date(data.expires_at).toLocaleDateString()}</p>
                            </div>
                            <div class="mt-6 p-4 bg-green-50 rounded-lg">
                                <p class="text-green-800 text-sm">✓ Access Granted</p>
                            </div>
                        </div>
                    `;
                } else {
                    resultDiv.innerHTML = `
                        <div class="text-center">
                            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-red-600 mb-2">Invalid Membership</h2>
                            <p class="text-gray-700 mb-4">${data.message}</p>
                            <div class="mt-6 p-4 bg-red-50 rounded-lg">
                                <p class="text-red-800 text-sm">✗ Access Denied</p>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                const resultDiv = document.getElementById('verification-result');
                resultDiv.innerHTML = `
                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-red-600 mb-2">Verification Error</h2>
                        <p class="text-gray-700">Unable to verify membership. Please try again or contact staff.</p>
                    </div>
                `;
            });
    </script>
</body>
</html> 