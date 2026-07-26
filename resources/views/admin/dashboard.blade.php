<x-layouts.admin>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="pageTitle">Admin Dashboard</x-slot>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => 'Total Users',       'value' => '0', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'text-brand'],
            ['label' => 'Active Members',    'value' => '0', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'text-state-success'],
            ['label' => 'Published Courses', 'value' => '0', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'color' => 'text-charcoal'],
            ['label' => 'Open Tickets',      'value' => '0', 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'text-state-warning'],
        ] as $stat)
        <div class="stat-card">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-ivory-alt flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:1.125rem;height:1.125rem">
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Quick Actions --}}
        <div class="card">
            <div class="card-body">
                <h2 class="font-heading font-semibold text-charcoal text-lg mb-5">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-3">
                    @foreach([
                        ['label' => 'Add Course',      'route' => 'admin.courses.create',      'icon' => 'M12 4v16m8-8H4'],
                        ['label' => 'Schedule Session','route' => 'admin.sessions.create',     'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['label' => 'View Users',      'route' => 'admin.users.index',         'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                        ['label' => 'Open Support',    'route' => 'admin.support.index',       'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'],
                    ] as $action)
                    <a href="{{ route($action['route']) }}" class="card p-4 flex items-center gap-3 hover:border-brand/30 hover:-translate-y-0.5 transition-all duration-200 group">
                        <div class="w-8 h-8 rounded-lg bg-brand/8 flex items-center justify-center group-hover:bg-brand transition-colors duration-200 flex-shrink-0">
                            <svg class="text-brand group-hover:text-white transition-colors duration-200" style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="font-body font-medium text-charcoal text-sm">{{ $action['label'] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Recent Users placeholder --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-heading font-semibold text-charcoal text-lg">Recent Users</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-brand text-xs font-semibold">View all →</a>
                </div>
                <div class="text-center py-8">
                    <p class="text-charcoal-muted text-sm">No users yet.</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
