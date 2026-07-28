<x-layouts.student>
    <x-slot name="title">Support</x-slot>
    <x-slot name="pageTitle">Support</x-slot>

    <x-caution-message class="mb-6" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- New Ticket Form --}}
        <div class="card lg:col-span-1">
            <div class="card-body">
                <h2 class="font-heading font-semibold text-charcoal text-base mb-4">New Support Ticket</h2>
                
                @if(session('success'))
                    <div class="alert-success mb-4" role="alert">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('student.support.store') }}" class="space-y-4">
                    @csrf
                    <div class="form-group">
                        <label for="subject" class="form-label">Subject</label>
                        <input id="subject" name="subject" type="text" class="form-input @error('subject') border-state-error @enderror" placeholder="Brief description of your issue" value="{{ old('subject') }}" required>
                        @error('subject')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" class="form-textarea @error('message') border-state-error @enderror" placeholder="Describe your issue in detail..." rows="5" required>{{ old('message') }}</textarea>
                        @error('message')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit" class="btn-primary w-full justify-center">Submit Ticket</button>
                </form>
            </div>
        </div>

        {{-- Tickets list --}}
        <div class="card lg:col-span-2">
            <div class="card-body">
                <h2 class="font-heading font-semibold text-charcoal text-base mb-4">My Tickets History</h2>
                
                @if($tickets->isEmpty())
                    <div class="text-center py-12">
                        <div class="w-12 h-12 rounded-xl bg-ivory-alt flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-charcoal-muted/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <p class="text-charcoal-muted text-sm">No support tickets submitted yet.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-base">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Created</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td class="font-medium text-charcoal text-sm max-w-[200px] truncate">{{ $ticket->subject }}</td>
                                    <td>
                                        @if($ticket->status === 'open')
                                            <span class="badge-brand">Open</span>
                                        @elseif($ticket->status === 'closed')
                                            <span class="badge-success">Resolved</span>
                                        @else
                                            <span class="badge-warning">Pending Reply</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-xs uppercase font-semibold text-charcoal-muted">{{ $ticket->priority }}</span>
                                    </td>
                                    <td class="text-xs text-charcoal-muted">{{ $ticket->created_at->format('d M Y') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('student.support.show', $ticket->id) }}" class="btn-outline-brand btn-sm">View Thread</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.student>
