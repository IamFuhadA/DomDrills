<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' — DomDrills' : 'DomDrills Member Dashboard' }}</title>
    <meta name="robots" content="noindex, nofollow">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body
    class="font-body bg-ivory text-charcoal antialiased h-full"
    x-data="{ sidebarOpen: window.innerWidth >= 1024 }"
    @resize.window="sidebarOpen = window.innerWidth >= 1024"
>

<div class="flex h-full min-h-screen">

    {{-- =====================================================
         SIDEBAR
         ===================================================== --}}
    <aside
        id="student-sidebar"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed lg:static inset-y-0 left-0 z-40 w-64 flex flex-col
               bg-white border-r border-border
               transition-transform duration-300 ease-out"
        aria-label="Student navigation"
    >
        {{-- Sidebar Header --}}
        <div class="flex items-center gap-2.5 px-5 py-5 border-b border-border flex-shrink-0">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-gradient-brand flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                </div>
                <span class="font-heading font-bold text-base text-charcoal">Dom<span class="text-brand">Drills</span></span>
            </a>
        </div>

        {{-- Membership Badge --}}
        <div class="px-4 py-3 border-b border-border/50 flex-shrink-0">
            <div class="flex items-center gap-2 bg-brand/8 border border-brand/20 rounded-xl px-3 py-2">
                <div class="w-1.5 h-1.5 rounded-full bg-brand animate-pulse-soft flex-shrink-0"></div>
                <div class="flex-1 min-w-0">
                    <p class="text-brand text-2xs font-semibold uppercase tracking-wide truncate">Member Active</p>
                    {{-- TODO: Show actual plan & expiry --}}
                    <p class="text-brand/60 text-2xs truncate">Monthly Plan</p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1" aria-label="Student menu">

            <p class="text-2xs font-semibold text-charcoal-muted/50 uppercase tracking-widest px-3.5 pb-1 pt-2">Learning</p>

            <a href="{{ route('student.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'sidebar-link-active' : '' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('student.courses.index') }}"
               class="sidebar-link {{ request()->routeIs('student.courses.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Courses
            </a>

            <a href="{{ route('student.sessions.index') }}"
               class="sidebar-link {{ request()->routeIs('student.sessions.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 10l4.553-2.069A1 1 0 0121 8.828V16a2 2 0 01-2 2H5a2 2 0 01-2-2V8.828a1 1 0 01.553-.898L8 10m7 0v4H8v-4m7 0l-3.5-2.5L8 10"/>
                </svg>
                Live Sessions
            </a>

            <p class="text-2xs font-semibold text-charcoal-muted/50 uppercase tracking-widest px-3.5 pb-1 pt-5">Tools</p>

            <a href="{{ route('student.tools.index') }}"
               class="sidebar-link {{ request()->routeIs('student.tools.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                </svg>
                Trading Tools
            </a>

            <p class="text-2xs font-semibold text-charcoal-muted/50 uppercase tracking-widest px-3.5 pb-1 pt-5">Account</p>

            <a href="{{ route('student.profile.index') }}"
               class="sidebar-link {{ request()->routeIs('student.profile.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Profile
            </a>

            <a href="{{ route('student.support.index') }}"
               class="sidebar-link {{ request()->routeIs('student.support.*') ? 'sidebar-link-active' : '' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Support
            </a>
        </nav>

        {{-- Sidebar Footer --}}
        <div class="px-3 py-4 border-t border-border flex-shrink-0">
            {{-- User info --}}
            <div class="flex items-center gap-3 px-3.5 py-2 rounded-xl bg-ivory mb-2">
                <div class="w-8 h-8 rounded-full bg-brand/20 flex items-center justify-center flex-shrink-0">
                    <span class="font-heading font-bold text-brand text-sm">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-charcoal text-xs truncate">{{ auth()->user()->name ?? 'Member' }}</p>
                    <p class="text-charcoal-muted text-2xs truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-state-error/70 hover:text-state-error hover:bg-state-error/6">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Sidebar Overlay (mobile) --}}
    <div
        x-show="sidebarOpen && window.innerWidth < 1024"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-30 bg-charcoal/40 backdrop-blur-sm lg:hidden"
        aria-hidden="true"
    ></div>

    {{-- =====================================================
         MAIN CONTENT
         ===================================================== --}}
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        {{-- Topbar --}}
        <header class="flex items-center gap-4 px-4 sm:px-6 lg:px-8 h-16 bg-white border-b border-border flex-shrink-0" aria-label="Top bar">

            {{-- Mobile: Sidebar Toggle --}}
            <button
                @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-1.5 rounded-lg text-charcoal-muted hover:bg-ivory transition-colors duration-200"
                aria-label="Toggle sidebar"
                :aria-expanded="sidebarOpen"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Page title --}}
            <div class="flex-1">
                @isset($pageTitle)
                    <h2 class="font-heading font-semibold text-charcoal text-lg">{{ $pageTitle }}</h2>
                @endisset
            </div>

            {{-- Right: actions --}}
            <div class="flex items-center gap-3">
                {{-- Notifications placeholder --}}
                <button class="p-2 rounded-lg text-charcoal-muted hover:bg-ivory transition-colors duration-200 relative" aria-label="Notifications">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                {{-- Avatar --}}
                <a href="{{ route('student.profile.index') }}"
                   class="w-8 h-8 rounded-full bg-brand/20 flex items-center justify-center"
                   aria-label="My profile">
                    <span class="font-heading font-bold text-brand text-sm">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                </a>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto bg-ivory">
            <div class="container-page py-8">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>
