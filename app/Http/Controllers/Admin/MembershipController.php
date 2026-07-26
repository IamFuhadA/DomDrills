<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MembershipPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MembershipController extends Controller
{
    public function index(): View
    {
        $plans = MembershipPlan::orderBy('price')->get();
        return view('admin.memberships.index', compact('plans'));
    }

    public function create(): View
    {
        return view('admin.memberships.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_period' => ['required', 'string', 'in:monthly,quarterly,yearly'],
            'description' => ['required', 'string'],
            'features_raw' => ['required', 'string'],
        ]);

        $features = array_filter(array_map('trim', explode("\n", $validated['features_raw'])));

        MembershipPlan::create([
            'name' => $validated['name'],
            'slug' => str($validated['name'])->slug(),
            'price' => $validated['price'],
            'billing_period' => $validated['billing_period'],
            'description' => $validated['description'],
            'features' => $features,
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan created successfully.');
    }

    public function edit(MembershipPlan $membership): View
    {
        return view('admin.memberships.edit', ['plan' => $membership]);
    }

    public function update(Request $request, MembershipPlan $membership): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'billing_period' => ['required', 'string', 'in:monthly,quarterly,yearly'],
            'description' => ['required', 'string'],
            'features_raw' => ['required', 'string'],
        ]);

        $features = array_filter(array_map('trim', explode("\n", $validated['features_raw'])));

        $membership->update([
            'name' => $validated['name'],
            'slug' => str($validated['name'])->slug(),
            'price' => $validated['price'],
            'billing_period' => $validated['billing_period'],
            'description' => $validated['description'],
            'features' => $features,
        ]);

        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan updated successfully.');
    }

    public function destroy(MembershipPlan $membership): RedirectResponse
    {
        $membership->delete();
        return redirect()->route('admin.memberships.index')->with('success', 'Membership plan deleted successfully.');
    }
}
