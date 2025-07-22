<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\Goal;
use App\Models\ProgressLog;

class DashboardController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $membership = $user->membership()->with(['package', 'payments'])->first();
        $pendingPayments = $user->payments()->where('status', Payment::STATUS_PENDING)->get();
        $recentProgressLogs = $user->progressLogs()->latest()->limit(5)->get();
        $activeGoals = $user->goals()->where('status', Goal::STATUS_ACTIVE)->get();
        $services = $user->services()->get();

        return view('dashboard.index', compact(
            'user', 
            'membership', 
            'pendingPayments', 
            'recentProgressLogs', 
            'activeGoals',
            'services'
        ));
    }

    /**
     * Show membership card.
     */
    public function membershipCard()
    {
        $user = Auth::user();
        $membership = $user->membership()->with('package')->first();

        if (!$membership || $membership->status === Membership::STATUS_PENDING) {
            return redirect()->route('dashboard')->with('error', 'Membership card not available. Please complete payment first.');
        }

        return view('dashboard.membership-card', compact('user', 'membership'));
    }

    public function downloadMembershipCard()
    {
        $user = Auth::user();
        $membership = $user->membership()->with('package')->first();

        if (!$membership || $membership->status === Membership::STATUS_PENDING) {
            return redirect()->route('dashboard')->with('error', 'Membership card not available. Please complete payment first.');
        }

        // Return the same view but with download headers
        return response()
            ->view('dashboard.membership-card', compact('user', 'membership'))
            ->header('Content-Disposition', 'attachment; filename=membership-card-' . $user->name . '.html');
    }

    /**
     * Show progress tracking page.
     */
    public function progress()
    {
        $user = Auth::user();
        $progressLogs = $user->progressLogs()->latest()->paginate(10);
        $goals = $user->goals()->get();

        return view('dashboard.progress', compact('user', 'progressLogs', 'goals'));
    }

    /**
     * Store progress log.
     */
    public function storeProgress(Request $request)
    {
        $request->validate([
            'goal_id' => ['nullable', 'exists:goals,id'],
            'current_weight' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'body_fat_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'muscle_mass' => ['nullable', 'numeric', 'min:0', 'max:500'],
            'notes' => ['nullable', 'string', 'max:500'],
            'progress_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        // Handle file upload
        $photoPath = null;
        if ($request->hasFile('progress_photo')) {
            $photoPath = $request->file('progress_photo')->store('progress-photos', 'public');
        }

                 $progressLog = ProgressLog::create([
            'user_id' => $user->id,
            'goal_id' => $request->goal_id,
            'date' => now()->toDateString(),
            'weight' => $request->current_weight,
            'body_fat_percentage' => $request->body_fat_percentage,
            'muscle_mass' => $request->muscle_mass,
            'notes' => $request->notes,
            'photos' => $photoPath ? [$photoPath] : null,
        ]);

        // Update goal progress if goal is specified
        if ($request->goal_id && $request->current_weight) {
            $goal = Goal::find($request->goal_id);
            if ($goal && $goal->unit === 'kg' && $goal->user_id === $user->id) {
                $goal->update(['current_value' => $request->current_weight]);
            }
        }

        return redirect()->route('progress')->with('success', 'Progress logged successfully!');
    }

    /**
     * Show goals page.
     */
    public function goals()
    {
        $user = Auth::user();
        $goals = $user->goals()->latest()->paginate(10);

        return view('dashboard.goals', compact('user', 'goals'));
    }

    /**
     * Store new goal.
     */
    public function storeGoal(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'target_value' => ['required', 'numeric', 'min:0'],
            'current_value' => ['nullable', 'numeric', 'min:0'],
            'unit' => ['required', 'string', 'max:20'],
            'target_date' => ['required', 'date', 'after:today'],
            'before_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = Auth::user();

        // Handle before photo upload
        $beforePhotoPath = null;
        if ($request->hasFile('before_photo')) {
            $beforePhotoPath = $request->file('before_photo')->store('goal-photos', 'public');
        }

        Goal::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'target_value' => $request->target_value,
            'current_value' => $request->current_value ?? 0,
            'unit' => $request->unit,
            'target_date' => $request->target_date,
            'status' => Goal::STATUS_ACTIVE,
            'before_photo' => $beforePhotoPath,
        ]);

        return redirect()->route('goals')->with('success', 'Goal created successfully!');
    }

    /**
     * Update goal.
     */
    public function updateGoal(Request $request, Goal $goal)
    {
        // Check if user owns the goal
        if ($goal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'target_value' => ['required', 'numeric', 'min:0'],
            'current_value' => ['nullable', 'numeric', 'min:0'],
            'unit' => ['required', 'string', 'max:20'],
            'target_date' => ['required', 'date'],
            'status' => ['required', 'in:active,completed,paused,cancelled'],
            'after_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle after photo upload
        $afterPhotoPath = $goal->after_photo;
        if ($request->hasFile('after_photo')) {
            // Delete old photo if exists
            if ($afterPhotoPath) {
                Storage::disk('public')->delete($afterPhotoPath);
            }
            $afterPhotoPath = $request->file('after_photo')->store('goal-photos', 'public');
        }

        $goal->update([
            'title' => $request->title,
            'description' => $request->description,
            'target_value' => $request->target_value,
            'current_value' => $request->current_value,
            'unit' => $request->unit,
            'target_date' => $request->target_date,
            'status' => $request->status,
            'after_photo' => $afterPhotoPath,
        ]);

        return redirect()->route('goals')->with('success', 'Goal updated successfully!');
    }

    /**
     * Delete goal.
     */
    public function deleteGoal(Goal $goal)
    {
        // Check if user owns the goal
        if ($goal->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete photos
        if ($goal->before_photo) {
            Storage::disk('public')->delete($goal->before_photo);
        }
        if ($goal->after_photo) {
            Storage::disk('public')->delete($goal->after_photo);
        }

        $goal->delete();

        return redirect()->route('goals')->with('success', 'Goal deleted successfully!');
    }
}
