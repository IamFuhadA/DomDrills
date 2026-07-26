<x-layouts.student>
    <x-slot name="title">Live Sessions</x-slot>
    <x-slot name="pageTitle">Live Sessions</x-slot>

    <div class="space-y-10">
        
        {{-- =====================================================
             1. Upcoming Live Sessions
             ===================================================== --}}
        <div>
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h2 class="font-heading font-bold text-xl text-charcoal">Upcoming Sessions</h2>
                    <p class="text-charcoal-muted text-xs">Scheduled institutional webinars and interactive order flow reviews.</p>
                </div>
                <span class="badge-success">Live Soon</span>
            </div>

            @php
                $upcoming = $sessions->filter(fn($s) => $s->isUpcoming());
            @endphp

            @if($upcoming->isEmpty())
                <div class="card p-10 text-center text-charcoal-muted text-sm">
                    No upcoming live sessions scheduled. Check back soon.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($upcoming as $session)
                    <div class="card border-brand/20 bg-brand/3 flex flex-col justify-between">
                        <div class="card-body">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <span class="text-brand text-2xs font-semibold uppercase tracking-wider">Scheduled Live</span>
                                <span class="text-charcoal-muted text-xs flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $session->duration_minutes }} mins
                                </span>
                            </div>
                            <h3 class="font-heading font-bold text-base text-charcoal mb-2">{{ $session->title }}</h3>
                            <p class="text-charcoal-muted text-xs leading-relaxed mb-5">{{ $session->description }}</p>
                            
                            <div class="p-3.5 bg-white border border-brand/10 rounded-xl mb-5 text-xs space-y-1.5">
                                <p class="text-charcoal-muted"><strong>Date:</strong> {{ $session->scheduled_at->format('l, d F Y') }}</p>
                                <p class="text-charcoal-muted"><strong>Time:</strong> {{ $session->scheduled_at->format('h:i A') }} IST</p>
                            </div>
                        </div>
                        <div class="px-6 py-4.5 bg-ivory-alt/30 border-t border-border flex items-center justify-between gap-3">
                            <span class="text-brand font-semibold text-2xs animate-pulse-soft">Starts in {{ $session->scheduled_at->diffForHumans() }}</span>
                            @if($session->meeting_link)
                                <a href="{{ $session->meeting_link }}" target="_blank" class="btn-primary btn-sm">
                                    Join Zoom Meeting
                                </a>
                            @else
                                <span class="text-charcoal-muted text-xs">Link pending</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- =====================================================
             2. Past Recorded Sessions
             ===================================================== --}}
        <div>
            <div class="mb-5">
                <h2 class="font-heading font-bold text-xl text-charcoal">Session Recordings</h2>
                <p class="text-charcoal-muted text-xs">Watch past live stream sessions and comprehensive market recaps.</p>
            </div>

            @php
                $past = $sessions->filter(fn($s) => !$s->isUpcoming());
            @endphp

            @if($past->isEmpty())
                <div class="card p-10 text-center text-charcoal-muted text-sm">
                    No session recordings available yet.
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    @foreach($past as $session)
                    <div class="card flex flex-col justify-between">
                        <div class="card-body">
                            <div class="flex items-center justify-between gap-3 mb-3">
                                <span class="text-charcoal-muted text-2xs uppercase font-semibold">Recorded</span>
                                <span class="text-charcoal-muted text-xs flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $session->duration_minutes }} mins
                                </span>
                            </div>
                            <h3 class="font-heading font-bold text-base text-charcoal mb-2">{{ $session->title }}</h3>
                            <p class="text-charcoal-muted text-xs leading-relaxed mb-5 line-clamp-2">{{ $session->description }}</p>
                            
                            <div class="text-[10px] text-charcoal-muted bg-ivory-alt rounded px-2.5 py-1 inline-block">
                                {{ $session->scheduled_at->format('d M Y') }}
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-ivory-alt/30 border-t border-border flex justify-end">
                            <a href="{{ route('student.sessions.show', $session->id) }}" class="btn-outline-brand btn-sm w-full justify-center text-center">
                                Watch Recording
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-layouts.student>
