<x-layouts.admin>
    <x-slot name="title">Support Ticket #{{ $ticket->id }}</x-slot>
    <x-slot name="pageTitle">Support Ticket #{{ $ticket->id }}</x-slot>

    {{-- Breadcrumb --}}
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.support.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Queue
        </a>
        @if($ticket->status !== 'closed')
            <form method="POST" action="{{ route('admin.support.close', $ticket) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn-outline-brand btn-sm hover:bg-state-success hover:border-state-success hover:text-white transition-colors">
                    Mark as Resolved & Close
                </button>
            </form>
        @endif
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- Message Feed --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Topic Header --}}
            <div class="card">
                <div class="card-body">
                    <span class="text-xs text-charcoal-muted">Subject</span>
                    <h2 class="font-heading font-bold text-lg text-charcoal mt-1">{{ $ticket->subject }}</h2>
                    
                    <div class="flex items-center gap-6 mt-4 pt-4 border-t border-border text-xs text-charcoal-muted">
                        <p><strong>Student:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
                        <p><strong>Opened:</strong> {{ $ticket->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>
            </div>

            {{-- Message History --}}
            <div class="space-y-4">
                @foreach($ticket->messages as $msg)
                    @php
                        $isAdmin = $msg->sender->isAdmin();
                    @endphp
                    <div class="flex {{ $isAdmin ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-[85%] rounded-2xl p-5 border shadow-sm
                                    {{ $isAdmin ? 'bg-brand/5 border-brand/15 text-charcoal' : 'bg-white border-border text-charcoal' }}">
                            <div class="flex items-center justify-between gap-6 mb-2 border-b border-border/40 pb-1.5">
                                <span class="font-heading font-semibold text-xs {{ $isAdmin ? 'text-brand' : 'text-charcoal' }}">
                                    {{ $msg->sender->name }}
                                    @if($isAdmin)
                                        <span class="text-[9px] uppercase tracking-wider bg-brand/10 text-brand px-1.5 py-0.5 rounded font-bold ml-1">Staff</span>
                                    @endif
                                </span>
                                <span class="text-[10px] text-charcoal-muted/70">
                                    {{ $msg->created_at->format('d M y, h:i A') }}
                                </span>
                            </div>
                            <p class="text-sm leading-relaxed whitespace-pre-line">{{ $msg->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Reply Form --}}
            @if($ticket->status !== 'closed')
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-heading font-semibold text-charcoal text-base mb-4">Send Reply to Student</h3>
                        <form method="POST" action="{{ route('admin.support.reply', $ticket) }}" class="space-y-4">
                            @csrf
                            <div class="form-group">
                                <textarea id="admin-reply-message" name="message" class="form-textarea" placeholder="Type your reply here..." rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Send Response</button>
                        </form>
                    </div>
                </div>
            @endif

        </div>

        {{-- Sidebar metadata --}}
        <div class="card lg:col-span-1">
            <div class="card-body">
                <h3 class="font-heading font-semibold text-charcoal text-base mb-4">Ticket Metadata</h3>
                <div class="text-xs text-charcoal-muted space-y-3">
                    <p><strong>Status:</strong> 
                        @if($ticket->status === 'open')
                            <span class="badge-brand">Open</span>
                        @elseif($ticket->status === 'closed')
                            <span class="badge-success">Resolved</span>
                        @else
                            <span class="badge-warning">Staff Replied</span>
                        @endif
                    </p>
                    <p><strong>Priority:</strong> <span class="uppercase font-semibold text-charcoal">{{ $ticket->priority }}</span></p>
                    <p><strong>Customer ID:</strong> #{{ $ticket->user_id }}</p>
                </div>
            </div>
        </div>

    </div>
</x-layouts.admin>
