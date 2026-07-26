<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>{{ isset($title) ? $title . ' — DomDrills' : 'DomDrills — Professional Trading Education' }}</title>
    <meta name="description" content="{{ $description ?? 'DomDrills teaches institutional market understanding — Order Flow, Footprint, Volume Profile, Options, Gamma and Liquidity. Professional trading education for serious traders.' }}">
    <meta name="robots" content="index, follow">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ isset($title) ? $title . ' — DomDrills' : 'DomDrills — Professional Trading Education' }}">
    <meta property="og:description" content="{{ $description ?? 'Professional Trading Education focused on how institutions participate in markets.' }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
    <meta name="twitter:card" content="summary_large_image">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts (Google) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Extra head content --}}
    @stack('head')
</head>
<body class="font-body bg-ivory text-charcoal antialiased" x-data="{ mobileMenuOpen: false }">

    {{-- =====================================================
         NAVIGATION
         ===================================================== --}}
    <header
        id="main-nav"
        class="fixed top-0 inset-x-0 z-50 transition-all duration-300"
        x-data="{
            scrolled: false,
            init() {
                window.addEventListener('scroll', () => {
                    this.scrolled = window.scrollY > 20;
                });
            }
        }"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-border' : 'bg-transparent'"
    >
        <nav class="container-page">
            <div class="flex items-center justify-between h-16 lg:h-18">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group" aria-label="DomDrills Home">
                    <div class="w-8 h-8 rounded-lg bg-gradient-brand flex items-center justify-center shadow-brand transition-all duration-300 group-hover:shadow-brand-lg">
                        <svg class="w-4.5 h-4.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <span class="font-heading font-bold text-lg text-charcoal tracking-tight">Dom<span class="text-brand">Drills</span></span>
                </a>

                {{-- Desktop Nav --}}
                <nav class="hidden lg:flex items-center gap-1" aria-label="Main navigation">
                    <a href="{{ route('home') }}"
                       class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                        {{ __('nav.home') }}
                    </a>
                    <a href="{{ route('services') }}"
                       class="nav-link {{ request()->routeIs('services') ? 'nav-link-active' : '' }}">
                        {{ __('nav.services') }}
                    </a>
                    <a href="{{ route('membership') }}"
                       class="nav-link {{ request()->routeIs('membership') ? 'nav-link-active' : '' }}">
                        {{ __('nav.membership') }}
                    </a>
                    <a href="{{ route('about') }}"
                       class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}">
                        {{ __('nav.about') }}
                    </a>
                    <a href="{{ route('contact') }}"
                       class="nav-link {{ request()->routeIs('contact') ? 'nav-link-active' : '' }}">
                        {{ __('nav.contact') }}
                    </a>
                </nav>

                {{-- Right side --}}
                <div class="hidden lg:flex items-center gap-3">
                    {{-- Language Switcher --}}
                    <div class="lang-switcher border border-border rounded-lg p-0.5" role="navigation" aria-label="Language switcher">
                        <a href="{{ route('lang.switch', 'en') }}"
                           id="lang-en"
                           class="lang-btn {{ app()->getLocale() === 'en' ? 'lang-btn-active' : '' }}">
                            EN
                        </a>
                        <a href="{{ route('lang.switch', 'ml') }}"
                           id="lang-ml"
                           class="lang-btn {{ app()->getLocale() === 'ml' ? 'lang-btn-active' : '' }}">
                            മലയാളം
                        </a>
                    </div>

                    @auth
                        <a href="{{ route('student.dashboard') }}" class="btn-secondary btn-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" id="nav-login" class="btn-ghost btn-sm">
                            {{ __('nav.login') }}
                        </a>
                        <a href="{{ route('register') }}" id="nav-register" class="btn-primary btn-sm">
                            {{ __('nav.register') }}
                        </a>
                    @endauth
                </div>

                {{-- Mobile Hamburger --}}
                <button
                    id="mobile-menu-toggle"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 rounded-lg text-charcoal-muted hover:bg-ivory transition-colors duration-200"
                    :aria-expanded="mobileMenuOpen"
                    aria-controls="mobile-menu"
                    aria-label="Toggle menu"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </nav>

        {{-- Mobile Menu --}}
        <div
            id="mobile-menu"
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="lg:hidden border-t border-border bg-white/95 backdrop-blur-md"
            @click.away="mobileMenuOpen = false"
        >
            <div class="container-page py-4 flex flex-col gap-1">
                <a href="{{ route('home') }}" class="sidebar-link {{ request()->routeIs('home') ? 'sidebar-link-active' : '' }}">{{ __('nav.home') }}</a>
                <a href="{{ route('services') }}" class="sidebar-link {{ request()->routeIs('services') ? 'sidebar-link-active' : '' }}">{{ __('nav.services') }}</a>
                <a href="{{ route('membership') }}" class="sidebar-link {{ request()->routeIs('membership') ? 'sidebar-link-active' : '' }}">{{ __('nav.membership') }}</a>
                <a href="{{ route('about') }}" class="sidebar-link {{ request()->routeIs('about') ? 'sidebar-link-active' : '' }}">{{ __('nav.about') }}</a>
                <a href="{{ route('contact') }}" class="sidebar-link {{ request()->routeIs('contact') ? 'sidebar-link-active' : '' }}">{{ __('nav.contact') }}</a>

                <div class="border-t border-border pt-3 mt-2 flex flex-col gap-2">
                    {{-- Language --}}
                    <div class="flex items-center gap-2 px-3">
                        <span class="text-xs text-charcoal-muted">Language:</span>
                        <a href="{{ route('lang.switch', 'en') }}" class="lang-btn {{ app()->getLocale() === 'en' ? 'lang-btn-active' : '' }}">EN</a>
                        <a href="{{ route('lang.switch', 'ml') }}" class="lang-btn {{ app()->getLocale() === 'ml' ? 'lang-btn-active' : '' }}">മലയാളം</a>
                    </div>
                    @auth
                        <a href="{{ route('student.dashboard') }}" class="btn-secondary w-full text-center">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ghost w-full text-center">{{ __('nav.login') }}</a>
                        <a href="{{ route('register') }}" class="btn-primary w-full text-center">{{ __('nav.register') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    {{-- =====================================================
         PAGE CONTENT
         ===================================================== --}}
    <main id="main-content" class="pt-16 lg:pt-18">
        {{ $slot }}
    </main>

    {{-- =====================================================
         FOOTER
         ===================================================== --}}
    <footer class="bg-charcoal text-white" aria-label="Site footer">
        <div class="container-page py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

                {{-- Brand Column --}}
                <div class="lg:col-span-1 space-y-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-gradient-brand flex items-center justify-center">
                            <svg class="w-4.5 h-4.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                        </div>
                        <span class="font-heading font-bold text-lg text-white tracking-tight">Dom<span class="text-brand">Drills</span></span>
                    </a>
                    <p class="text-white/55 text-sm leading-relaxed">
                        Professional trading education focused on how institutions participate in markets.
                    </p>
                    {{-- Social --}}
                    <div class="flex items-center gap-3 pt-1">
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/8 flex items-center justify-center text-white/60 hover:bg-brand hover:text-white transition-all duration-200" aria-label="YouTube">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/8 flex items-center justify-center text-white/60 hover:bg-brand hover:text-white transition-all duration-200" aria-label="Twitter/X">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/8 flex items-center justify-center text-white/60 hover:bg-brand hover:text-white transition-all duration-200" aria-label="Telegram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-lg bg-white/8 flex items-center justify-center text-white/60 hover:bg-brand hover:text-white transition-all duration-200" aria-label="Instagram">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Platform --}}
                <div class="space-y-4">
                    <h3 class="font-heading font-semibold text-sm text-white/90 uppercase tracking-widest">Platform</h3>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Home</a></li>
                        <li><a href="{{ route('services') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Services</a></li>
                        <li><a href="{{ route('membership') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Membership</a></li>
                        <li><a href="{{ route('about') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">About</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Contact</a></li>
                    </ul>
                </div>

                {{-- Legal --}}
                <div class="space-y-4">
                    <h3 class="font-heading font-semibold text-sm text-white/90 uppercase tracking-widest">Legal</h3>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('privacy') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Terms of Service</a></li>
                        <li><a href="{{ route('risk-disclosure') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Risk Disclosure</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white/55 text-sm hover:text-white transition-colors duration-200">Support</a></li>
                    </ul>
                </div>

                {{-- Risk Notice --}}
                <div class="space-y-4">
                    <h3 class="font-heading font-semibold text-sm text-white/90 uppercase tracking-widest">Risk Notice</h3>
                    <p class="text-white/40 text-xs leading-relaxed">
                        Trading futures, options and financial markets involves substantial risk of loss. DomDrills provides educational content only. We do not provide investment advice or guarantee profitability. All trading decisions are your sole responsibility.
                    </p>
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-state-warning/70"></div>
                        <span class="text-state-warning/70 text-xs font-medium">Educational Platform Only</span>
                    </div>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-white/35 text-xs">
                    &copy; {{ date('Y') }} DomDrills. All rights reserved.
                </p>
                <p class="text-white/25 text-xs">
                    Built for serious traders. Focused on education.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
