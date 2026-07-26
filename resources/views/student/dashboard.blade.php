<x-layouts.student>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="pageTitle">Dashboard</x-slot>

    {{-- =====================================================
         Welcome Banner
         ===================================================== --}}
    <div class="bg-gradient-to-r from-brand to-brand-hover rounded-2xl p-6 lg:p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" aria-hidden="true">
            <svg class="w-full h-full" viewBox="0 0 400 200" fill="none">
                <path d="M0 100 Q100 50 200 100 Q300 150 400 100" stroke="white" stroke-width="1" fill="none" opacity="0.5"/>
                <path d="M0 120 Q100 70 200 120 Q300 170 400 120" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
                <path d="M0 80 Q100 30 200 80 Q300 130 400 80" stroke="white" stroke-width="1" fill="none" opacity="0.3"/>
            </svg>
        </div>
        <div class="relative z-10">
            <p class="text-white/70 text-sm font-body mb-1">Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }},</p>
            <h1 class="font-heading font-bold text-2xl lg:text-3xl text-white mb-2">
                {{ auth()->user()->name ?? 'Member' }}
            </h1>
            <p class="text-white/70 text-sm">Continue your learning journey below.</p>
        </div>
    </div>

    {{-- =====================================================
         Stats Row
         ===================================================== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => 'Lessons Completed', 'value' => '0', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-state-success', 'bg' => 'bg-state-success/10'],
            ['label' => 'Courses Enrolled',  'value' => '0', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'text-brand', 'bg' => 'bg-brand/10'],
            ['label' => 'Sessions Watched',  'value' => '0', 'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-state-warning', 'bg' => 'bg-state-warning/10'],
            ['label' => 'Days Active',       'value' => '1',  'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'text-charcoal-muted', 'bg' => 'bg-ivory-alt'],
        ] as $stat)
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl {{ $stat['bg'] }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <p class="stat-value text-2xl">{{ $stat['value'] }}</p>
                    <p class="stat-label text-xs">{{ $stat['label'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- =====================================================
         Main Grid
         ===================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Continue Learning --}}
        <div class="lg:col-span-2 card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-heading font-bold text-charcoal text-lg">Continue Learning</h2>
                    <a href="{{ route('student.courses.index') }}" class="text-brand text-xs font-semibold hover:text-brand-hover transition-colors duration-200">
                        All Courses →
                    </a>
                </div>

                {{-- Empty state --}}
                <div class="text-center py-12">
                    <div class="w-14 h-14 rounded-2xl bg-brand/8 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-brand/60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="font-heading font-semibold text-charcoal mb-1">No courses yet</p>
                    <p class="text-charcoal-muted text-sm mb-5">Your enrolled courses will appear here.</p>
                    <a href="{{ route('student.courses.index') }}" class="btn-primary btn-sm">Browse Courses</a>
                </div>
            </div>
        </div>

        {{-- Right column --}}
        <div class="space-y-5">

            {{-- Upcoming Session --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-heading font-semibold text-charcoal text-base">Upcoming Session</h2>
                        <span class="badge-success">Live</span>
                    </div>
                    <div class="text-center py-6">
                        <div class="w-10 h-10 rounded-xl bg-state-success/10 flex items-center justify-center mx-auto mb-3">
                            <svg class="w-5 h-5 text-state-success" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-charcoal-muted text-sm">No upcoming sessions scheduled</p>
                        <a href="{{ route('student.sessions.index') }}" class="text-brand text-xs font-semibold mt-2 inline-block">View all sessions →</a>
                    </div>
                </div>
            </div>

            {{-- Membership Status --}}
            <div class="card border-brand/15 bg-brand/3">
                <div class="card-body">
                    <h2 class="font-heading font-semibold text-charcoal text-base mb-4">Membership</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-charcoal-muted text-sm">Status</span>
                            <span class="badge-success">Active</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-charcoal-muted text-sm">Plan</span>
                            <span class="font-medium text-charcoal text-sm">Monthly</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-charcoal-muted text-sm">Renews</span>
                            <span class="font-medium text-charcoal text-sm">—</span>
                        </div>
                    </div>
                    <a href="{{ route('student.profile.index') }}" class="btn-outline-brand btn-sm w-full justify-center mt-5">Manage</a>
                </div>
            </div>

            {{-- Latest Announcement --}}
            <div class="card">
                <div class="card-body">
                    <h2 class="font-heading font-semibold text-charcoal text-base mb-3">Announcements</h2>
                    <div class="text-center py-4">
                        <p class="text-charcoal-muted text-sm">No new announcements.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.student>
