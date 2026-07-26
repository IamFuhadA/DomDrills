<x-layouts.admin>
    <x-slot name="title">Support Tickets</x-slot>
    <x-slot name="pageTitle">Support Tickets</x-slot>

    <div class="mb-6">
        <h1 class="font-heading font-bold text-2xl text-charcoal">Support Queue</h1>
        <p class="text-charcoal-muted text-xs">Manage active and resolved support inquiries from students.</p>
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card overflow-hidden">
        @if($tickets->isEmpty())
            <div class="p-12 text-center text-charcoal-muted text-sm">
                No support tickets have been submitted yet.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Student</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Created</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td class="text-xs font-bold text-charcoal-muted">#{{ $ticket->id }}</td>
                            <td class="font-medium text-charcoal text-sm">{{ $ticket->user->name }}</td>
                            <td class="text-sm truncate max-w-[200px]">{{ $ticket->subject }}</td>
                            <td>
                                @if($ticket->status === 'open')
                                    <span class="badge-brand">Open</span>
                                @elseif($ticket->status === 'closed')
                                    <span class="badge-success">Resolved</span>
                                @else
                                    <span class="badge-warning">Staff Replied</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-2xs font-semibold uppercase tracking-wider text-charcoal-muted">{{ $ticket->priority }}</span>
                            </td>
                            <td class="text-xs text-charcoal-muted">{{ $ticket->created_at->format('d M Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.support.show', $ticket) }}" class="btn-outline-brand btn-sm">Answer</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.admin>
