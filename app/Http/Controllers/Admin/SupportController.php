<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function index(): View
    {
        $tickets = SupportTicket::with('user')->latest()->get();
        return view('admin.support.index', compact('tickets'));
    }

    public function show(SupportTicket $ticket): View
    {
        $ticket->load('messages.sender');
        return view('admin.support.show', compact('ticket'));
    }

    public function reply(Request $request, SupportTicket $ticket): RedirectResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:3000'],
        ]);

        DB::transaction(function () use ($ticket, $validated) {
            $ticket->messages()->create([
                'sender_id' => auth()->id(),
                'message' => $validated['message'],
            ]);

            $ticket->update(['status' => 'pending_reply']);
        });

        return back()->with('success', 'Reply sent successfully.');
    }

    public function close(SupportTicket $ticket): RedirectResponse
    {
        $ticket->update(['status' => 'closed']);
        return back()->with('success', 'Ticket closed successfully.');
    }
}
