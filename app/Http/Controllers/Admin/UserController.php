<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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
        // 1. Generate unique Login ID in DOMXXXX format
        $loginId = 'DOM' . (1000 + $user->id);

        // 2. Save Login ID
        $user->update([
            'login_id' => $loginId,
        ]);

        // 3. Grant active membership if they don't have one
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

        // 4. Send Login ID with a secure password reset link.
        $resetUrl = url(route('password.reset', [
            'token' => Password::broker()->createToken($user),
            'email' => $user->email,
        ], false));

        $mailSent = false;
        try {
            \Illuminate\Support\Facades\Mail::raw(
                "Hello {$user->name},\n\nYour DomDrills account has been approved and activated.\n\nLogin ID: {$loginId}\nSet or reset your password here: {$resetUrl}\n\nYou can log in at: " . route('login') . "\n\n----------------------------------------\nCAUTION NOTICE:\nPlease take note that all the payments are done personally. If someone impersonates us and mails or contacts you at any other time, please avoid it and contact us for verifying if it is genuine or not. For any loss by jumping into it, we are not responsible.\n----------------------------------------\n\nBest regards,\nDomDrills Team",
                function ($message) use ($user) {
                    $message->to($user->email)->subject('DomDrills Account Activated');
                }
            );
            $mailSent = true;
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send credentials mail: " . $e->getMessage());
            \Illuminate\Support\Facades\Log::info("MOCK ACCOUNT ACTIVATION MAIL TO {$user->email} - Login ID: {$loginId}, Password reset URL: {$resetUrl}");
        }

        $msg = 'Student Login ID (' . $loginId . ') generated successfully and active membership granted.';
        if ($mailSent) {
            $msg .= ' Welcome email sent to student.';
        } else {
            $msg .= ' (Email logged locally; SMTP server pending configuration).';
        }

        return back()->with('success', $msg);
    }
}
