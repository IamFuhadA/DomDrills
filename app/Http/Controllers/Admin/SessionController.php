<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function index(): View
    {
        $sessions = LiveSession::orderBy('scheduled_at', 'desc')->get();
        return view('admin.sessions.index', compact('sessions'));
    }

    public function create(): View
    {
        return view('admin.sessions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'scheduled_at' => ['required', 'date'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'meeting_link' => ['nullable', 'url'],
            'status' => ['required', 'string'],
        ]);

        $validated['slug'] = str($validated['title'])->slug();

        LiveSession::create($validated);

        return redirect()->route('admin.sessions.index')->with('success', 'Live session scheduled successfully.');
    }

    public function show(LiveSession $session): View
    {
        return view('admin.sessions.show', compact('session'));
    }

    public function edit(LiveSession $session): View
    {
        return view('admin.sessions.edit', compact('session'));
    }

    public function update(Request $request, LiveSession $session): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'scheduled_at' => ['required', 'date'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'meeting_link' => ['nullable', 'url'],
            'status' => ['required', 'string'],
        ]);

        $validated['slug'] = str($validated['title'])->slug();

        $session->update($validated);

        return redirect()->route('admin.sessions.index')->with('success', 'Live session updated successfully.');
    }

    public function destroy(LiveSession $session): RedirectResponse
    {
        $session->delete();
        return redirect()->route('admin.sessions.index')->with('success', 'Live session deleted successfully.');
    }
}
