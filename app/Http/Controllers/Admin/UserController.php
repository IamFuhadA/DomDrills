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
}
