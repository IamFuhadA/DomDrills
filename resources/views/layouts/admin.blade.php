<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' — Admin' : 'DomDrills Admin' }}</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-body bg-ivory text-charcoal antialiased h-full" x-data="{ sidebarOpen: window.innerWidth >= 1024 }">

<div class="flex h-full min-h-screen">

    {{-- Admin Sidebar --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 flex flex-col bg-charcoal transition-transform duration-300 ease-out"
        aria-label="Admin navigation"
    >
        {{-- Logo --}}
        <div class="flex items-center gap-2.5 px-5 py-5 border-b border-white/10 flex-shrink-0">
            <div class="w-7 h-7 rounded-lg bg-gradient-brand flex items-center justify-center">
                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <div>
                <span class="font-heading font-bold text-sm text-white">Dom<span class="text-brand">Drills</span></span>
                <p class="text-white/40 text-2xs font-body">Admin Panel</p>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">
            @php
            $adminLinks = [
                ['route' => 'admin.dashboard', 'label' => 'Dashboard',     'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'admin.users.index',       'label' => 'Users',          'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route' => 'admin.memberships.index', 'label' => 'Memberships',    'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                ['route' => 'admin.courses.index',     'label' => 'Courses',        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['route' => 'admin.sessions.index',    'label' => 'Sessions',       'icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route' => 'admin.tools.index',       'label' => 'Trading Tools',  'icon' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z'],
                ['route' => 'admin.support.index',     'label' => 'Support',        'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'],
                ['route' => 'admin.settings.index',    'label' => 'Settings',       'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ['route' => 'admin.logs.index',        'label' => 'Activity Logs',  'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
            ];
            @endphp

            @foreach($adminLinks as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                      {{ request()->routeIs(str_replace('.index','.*',$link['route'])) ? 'bg-white/10 text-white' : 'text-white/55 hover:text-white hover:bg-white/8' }}">
                <svg class="flex-shrink-0 text-current" style="width:1.125rem;height:1.125rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $link['icon'] }}"/>
                </svg>
                {{ $link['label'] }}
            </a>
            @endforeach
        </nav>

        {{-- Admin user footer --}}
        <div class="px-4 py-4 border-t border-white/10 flex-shrink-0">
            <div class="flex items-center gap-3 px-3 py-2 rounded-xl bg-white/5 mb-2">
                <div class="w-7 h-7 rounded-full bg-brand/30 flex items-center justify-center flex-shrink-0">
                    <span class="font-bold text-brand text-xs">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-white text-xs truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-white/40 text-2xs truncate">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 w-full px-3.5 py-2 rounded-xl text-white/40 hover:text-white hover:bg-white/8 text-sm transition-all duration-200">
                    <svg style="width:1rem;height:1rem" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Overlay mobile --}}
    <div x-show="sidebarOpen && window.innerWidth < 1024" @click="sidebarOpen = false"
         class="fixed inset-0 z-30 bg-charcoal/60 backdrop-blur-sm lg:hidden" aria-hidden="true"></div>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        {{-- Topbar --}}
        <header class="flex items-center gap-4 px-4 sm:px-6 lg:px-8 h-16 bg-white border-b border-border flex-shrink-0">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-1.5 rounded-lg text-charcoal-muted hover:bg-ivory transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="flex-1">
                @isset($pageTitle)
                    <h2 class="font-heading font-semibold text-charcoal text-lg">{{ $pageTitle }}</h2>
                @endisset
            </div>
            <a href="{{ route('home') }}" class="text-xs text-charcoal-muted hover:text-brand transition-colors" target="_blank">View Site →</a>
        </header>

        <main class="flex-1 overflow-y-auto bg-ivory">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
