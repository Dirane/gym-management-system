<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Service;
use App\Models\Announcement;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        $services = Service::where('is_active', true)->take(6)->get();
        $announcements = Announcement::published()->latest()->take(3)->get();
        
        return view('home', compact('packages', 'services', 'announcements'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $services = Service::where('is_active', true)->get();
        return view('services', compact('services'));
    }

    public function packages()
    {
        $packages = Package::where('is_active', true)->get();
        return view('packages', compact('packages'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function register()
    {
        $packages = Package::where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();
        return view('register', compact('packages', 'services'));
    }

    public function verifyMembership($cardNumber)
    {
        $membership = Membership::where('card_number', $cardNumber)
            ->with(['user', 'package'])
            ->first();

        if (!$membership) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid membership card number'
            ], 404);
        }

        $isValid = $membership->status === 'active' && $membership->end_date >= now();

        return response()->json([
            'valid' => $isValid,
            'status' => $membership->status,
            'member_name' => $membership->user->name,
            'package' => $membership->package->name,
            'expires_at' => $membership->end_date->format('Y-m-d'),
            'message' => $isValid ? 'Valid membership' : 'Membership is ' . $membership->status
        ]);
    }

    public function registerSubmit(Request $request)
    {
        // Validate the registration form
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'address' => ['nullable', 'string', 'max:500'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'emergency_phone' => ['nullable', 'string', 'max:20'],
            'medical_conditions' => ['nullable', 'string', 'max:1000'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'package_id' => ['required', 'exists:packages,id'],
            'services' => ['nullable', 'array'],
            'services.*' => ['exists:services,id'],
            'terms' => ['required', 'accepted'],
        ]);

        try {
            DB::beginTransaction();

            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'date_of_birth' => $validated['date_of_birth'],
                'address' => $validated['address'],
                'emergency_contact' => $validated['emergency_contact'],
                'emergency_phone' => $validated['emergency_phone'],
                'medical_conditions' => $validated['medical_conditions'],
                'password' => Hash::make($validated['password']),
                'email_verified_at' => now(), // Auto-verify for now
            ]);

            // Assign gym_member role
            $user->assignRole('gym_member');

            // Get the selected package
            $package = Package::findOrFail($validated['package_id']);

            // Calculate dates
            $startDate = now();
            $endDate = $startDate->copy()->addMonths($package->duration_months);

            // Generate unique card number (will be activated upon payment)
            $cardNumber = 'GYM' . str_pad($user->id, 6, '0', STR_PAD_LEFT) . rand(10, 99);

            // Calculate total cost (package + services)
            $totalServiceCost = 0;
            if (!empty($validated['services'])) {
                $selectedServices = Service::whereIn('id', $validated['services'])->get();
                $totalServiceCost = $selectedServices->sum('price');
            }

            // Create membership with PENDING status (awaiting payment confirmation)
            $membership = Membership::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => Membership::STATUS_PENDING, // Use the constant instead
                'registration_fee' => 5000.00, // Standard registration fee
                'monthly_fee' => $package->price / $package->duration_months,
                'discount_applied' => 0.00,
                'card_number' => $cardNumber,
            ]);

            // Attach selected services to the user if any
            if (!empty($validated['services']) && is_array($validated['services'])) {
                $user->services()->attach($validated['services']);
            }

            // Create initial payment record
            $totalAmount = $package->price + $totalServiceCost + 5000.00; // Package + Services + Registration fee
            
            \App\Models\Payment::create([
                'user_id' => $user->id,
                'membership_id' => $membership->id,
                'amount' => $totalAmount,
                'payment_type' => \App\Models\Payment::TYPE_REGISTRATION,
                'payment_method' => \App\Models\Payment::METHOD_CASH, // Default, will be updated
                'due_date' => now()->addDays(7), // 7 days to complete payment
                'status' => \App\Models\Payment::STATUS_PENDING,
                'reference_number' => 'REG-' . $user->id . '-' . time(),
                'notes' => 'Initial registration payment. Includes package, services, and registration fee.',
            ]);

            DB::commit();

            return redirect()->route('register')->with('success', 
                'Registration successful! Your application has been submitted. ' .
                'Please visit the gym within 7 days to complete payment (' . number_format($totalAmount) . ' FCFA) and receive your membership card. ' .
                'Your reference number is: REG-' . $user->id . '-' . time());

        } catch (\Exception $e) {
            DB::rollback();
            
            // Log the actual error for debugging
            \Log::error('Registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_email' => $validated['email'] ?? 'unknown'
            ]);
            
            // In development, show the actual error
            if (config('app.debug')) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['general' => 'Registration failed: ' . $e->getMessage()]);
            }
            
            return redirect()->back()
                ->withInput()
                ->withErrors(['general' => 'Registration failed. Please try again. If the problem persists, please contact us.']);
        }
    }
}
