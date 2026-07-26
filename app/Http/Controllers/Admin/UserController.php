<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(): RedirectResponse
    {
        return back();
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

    public function suspend(User $user): RedirectResponse
    {
        $user->update(['suspended_at' => now()]);
        return back()->with('success', 'User account suspended.');
    }

    public function activate(User $user): RedirectResponse
    {
        $user->update(['suspended_at' => null]);
        return back()->with('success', 'User account activated.');
    }

    public function toggleMembership(User $user): RedirectResponse
    {
        $active = $user->activeMembership;

        if ($active) {
            $active->update(['status' => 'expired']);
            return back()->with('success', 'Membership revoked.');
        }

        $plan = \App\Models\MembershipPlan::first();
        if ($plan) {
            $user->memberships()->create([
                'membership_plan_id' => $plan->id,
                'status' => 'active',
                'expires_at' => now()->addYears(1),
            ]);
        }

        return back()->with('success', 'Active membership granted for 1 year.');
    }

    public function sendCredentials(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'login_id' => ['required', 'string', 'min:3', 'unique:users,login_id,' . $user->id],
        ]);

        // 1. Save Login ID
        $user->update([
            'login_id' => $validated['login_id'],
        ]);

        // 2. Grant active membership if they don't have one
        if (!$user->activeMembership()->exists()) {
            $plan = \App\Models\MembershipPlan::first();
            if ($plan) {
                $user->memberships()->create([
                    'membership_plan_id' => $plan->id,
                    'status' => 'active',
                    'expires_at' => now()->addYears(1),
                ]);
            }
        }

        // 3. Send Credentials via Mail
        $passwordPlain = $user->password_plain ?? 'Your registered password';
        $mailSent = false;
        try {
            \Illuminate\Support\Facades\Mail::raw(
                "Hello {$user->name},\n\nYour account on DomDrills has been approved and activated!\n\nHere are your login credentials:\nLogin ID: {$validated['login_id']}\nPassword: {$passwordPlain}\n\nYou can log in at: " . route('login') . "\n\nBest regards,\nDomDrills Team",
                function ($message) use ($user) {
                    $message->to($user->email)->subject('DomDrills Account Activated - Credentials');
                }
            );
            $mailSent = true;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send credentials mail: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::info("MOCK CREDENTIAL MAIL TO {$user->email} - Login ID: {$validated['login_id']}, Password: {$passwordPlain}");
        }

        $msg = 'Student Login ID created successfully and active membership granted.';
        if ($mailSent) {
            $msg .= ' Welcome email sent to student.';
        } else {
            $msg .= ' (Email logged locally; SMTP server pending configuration).';
        }

        return back()->with('success', $msg);
    }
}
