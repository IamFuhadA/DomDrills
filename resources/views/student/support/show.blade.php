<x-layouts.student>
    <x-slot name="title">Ticket #{{ $ticket->id }} — {{ $ticket->subject }}</x-slot>
    <x-slot name="pageTitle">Support Ticket Thread</x-slot>

    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('student.support.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to support tickets
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        {{-- Message Thread --}}
        <div class="card lg:col-span-2 space-y-6 bg-transparent border-none shadow-none">
            
            {{-- Ticket Header Details --}}
            <div class="card">
                <div class="card-body flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <span class="text-charcoal-muted text-xs">Ticket #{{ $ticket->id }}</span>
                        <h1 class="font-heading font-bold text-lg text-charcoal mt-1">{{ $ticket->subject }}</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        @if($ticket->status === 'open')
                            <span class="badge-brand">Open</span>
                        @elseif($ticket->status === 'closed')
                            <span class="badge-success">Resolved</span>
                        @else
                            <span class="badge-warning">Pending Reply</span>
                        @endif
                        <span class="text-xs uppercase font-semibold text-charcoal-muted bg-ivory-alt border border-border rounded px-2.5 py-1">
                            {{ $ticket->priority }} Priority
                        </span>
                    </div>
                </div>
            </div>

            {{-- Message History --}}
            <div class="space-y-4">
                @foreach($ticket->messages as $msg)
                    @php
                        $isAdmin = $msg->sender->isAdmin();
                    @endphp
                    <div class="flex {{ $isAdmin ? 'justify-start' : 'justify-end' }}">
                        <div class="max-w-[85%] rounded-2xl p-5 border shadow-sm
                                    {{ $isAdmin ? 'bg-white border-border text-charcoal' : 'bg-brand/5 border-brand/15 text-charcoal' }}">
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
                        <h2 class="font-heading font-semibold text-charcoal text-base mb-4">Send a Reply</h2>
                        <form method="POST" action="{{ route('student.support.reply', $ticket->id) }}" class="space-y-4">
                            @csrf
                            <div class="form-group">
                                <textarea id="reply-message" name="message" class="form-textarea" placeholder="Type your reply here..." rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="alert-info text-center justify-center p-5 text-sm">
                    This support ticket has been resolved and closed. If you require further assistance, please open a new support ticket.
                </div>
            @endif

        </div>

        {{-- Right Column Info --}}
        <div class="card lg:col-span-1">
            <div class="card-body">
                <h3 class="font-heading font-semibold text-charcoal text-base mb-4">Support Guide</h3>
                <div class="text-charcoal-muted text-xs space-y-3 leading-relaxed">
                    <p>Our dedicated support team is available from <strong>9:00 AM to 6:00 PM IST</strong>, Monday through Saturday.</p>
                    <p>We target to resolve all tickets within <strong>24 business hours</strong>.</p>
                    <p>For urgent questions regarding live sessions, you can also ask directly during the sessions or inside our discord/community area.</p>
                </div>
            </div>
        </div>

    </div>
</x-layouts.student>
