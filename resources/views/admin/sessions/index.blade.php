<x-layouts.admin>
    <x-slot name="title">Sessions Management</x-slot>
    <x-slot name="pageTitle">Live Sessions</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="font-heading font-bold text-2xl text-charcoal">Live Webinar Sessions</h1>
            <p class="text-charcoal-muted text-xs">Manage webinar scheduling, live links and post-session recording streams.</p>
        </div>
        <a href="{{ route('admin.sessions.create') }}" class="btn-primary btn-sm flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Schedule Live Session
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card overflow-hidden">
        @if($sessions->isEmpty())
            <div class="p-12 text-center text-charcoal-muted text-sm">
                No webinar sessions scheduled yet. Click "Schedule Live Session" to add one.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                        <tr>
                            <td class="text-xs font-semibold text-brand">{{ $session->scheduled_at->format('d M Y, h:i A') }}</td>
                            <td class="font-semibold text-charcoal text-sm">{{ $session->title }}</td>
                            <td>
                                @if($session->status === 'scheduled')
                                    <span class="badge-brand">Scheduled</span>
                                @elseif($session->status === 'completed')
                                    <span class="badge-success">Completed</span>
                                @else
                                    <span class="badge-warning">{{ $session->status }}</span>
                                @endif
                            </td>
                            <td class="text-xs text-charcoal-muted">{{ $session->duration_minutes }} mins</td>
                            <td class="text-right space-x-2">
                                <a href="{{ route('admin.sessions.edit', $session) }}" class="text-charcoal-muted text-xs font-semibold hover:text-charcoal">Edit</a>
                                <span class="text-border">|</span>
                                <form method="POST" action="{{ route('admin.sessions.destroy', $session) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this session?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-state-error/80 text-xs font-semibold hover:text-state-error">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.admin>
