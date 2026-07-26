<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function index(): View
    {
        $tickets = auth()->user()->supportTickets()->latest()->get();
        return view('student.support.index', compact('tickets'));
    }

    public function show(int $id): View
    {
        $ticket = auth()->user()->supportTickets()->with(['messages.sender'])->findOrFail($id);
        return view('student.support.show', compact('ticket'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        DB::transaction(function () use ($validated) {
            $ticket = auth()->user()->supportTickets()->create([
                'subject' => $validated['subject'],
                'status' => 'open',
                'priority' => 'medium',
            ]);

            $ticket->messages()->create([
                'sender_id' => auth()->id(),
                'message' => $validated['message'],
            ]);
        });

        return back()->with('success', 'Support ticket submitted. We\'ll respond within 24 hours.');
    }

    public function reply(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $ticket = auth()->user()->supportTickets()->findOrFail($id);

        DB::transaction(function () use ($ticket, $validated) {
            $ticket->messages()->create([
                'sender_id' => auth()->id(),
                'message' => $validated['message'],
            ]);

            $ticket->update(['status' => 'open']);
        });

        return back()->with('success', 'Reply sent.');
    }
}
