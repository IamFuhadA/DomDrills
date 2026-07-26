<x-layouts.public>
    <x-slot name="title">Professional Trading Education</x-slot>
    <x-slot name="description">DomDrills teaches institutional market understanding — Order Flow, Footprint, Volume Profile, Options, Gamma and Liquidity. For serious traders who want to learn how professionals read markets.</x-slot>

    {{-- ===================================================
         HERO SECTION
         =================================================== --}}
    <section
        id="hero"
        class="relative min-h-screen flex items-center overflow-hidden bg-ivory"
        aria-label="Hero"
    >
        {{-- Animated Canvas Background --}}
        <canvas id="hero-canvas" class="absolute inset-0 w-full h-full" aria-hidden="true"></canvas>

        {{-- Radial gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-radial from-brand/4 via-transparent to-transparent pointer-events-none" aria-hidden="true"></div>

        <div class="container-page relative z-10 py-28 lg:py-36">
            <div class="max-w-4xl">

                {{-- Eyebrow --}}
                <div class="flex items-center gap-3 mb-8 animate-fade-up" style="animation-delay:100ms">
                    <div class="flex items-center gap-2 bg-brand/8 border border-brand/20 rounded-full px-4 py-1.5">
                        <div class="w-1.5 h-1.5 rounded-full bg-brand animate-pulse-soft"></div>
                        <span class="text-brand text-xs font-semibold font-body tracking-wide">Professional Trading Education</span>
                    </div>
                </div>

                {{-- Main Headline --}}
                <h1
                    class="font-heading font-bold text-charcoal mb-6 animate-fade-up"
                    style="font-size: clamp(3rem, 8vw, 6.5rem); line-height: 1.04; letter-spacing: -0.04em; animation-delay:200ms"
                >
                    READ WHAT<br>
                    <span class="text-brand">MOVES</span><br>
                    THE MARKET.
                </h1>

                {{-- Subheading --}}
                <p class="text-charcoal-muted text-lg lg:text-xl max-w-xl leading-relaxed mb-4 animate-fade-up" style="animation-delay:350ms">
                    {{ app()->getLocale() === 'ml'
                        ? 'Institutional market participation മനസ്സിലാക്കുക.'
                        : 'Institutional market education for professional traders.' }}
                </p>

                {{-- Concept Tags --}}
                <div class="flex flex-wrap gap-2 mb-10 animate-fade-up" style="animation-delay:450ms" aria-label="Topics covered">
                    @foreach(['Order Flow','Footprint','Volume Profile','Options','Gamma','Liquidity'] as $tag)
                        <span class="px-3 py-1 rounded-full bg-white border border-border text-charcoal-muted text-xs font-medium font-body shadow-xs">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col sm:flex-row gap-3 animate-fade-up" style="animation-delay:550ms">
                    <a href="{{ route('register') }}" id="hero-cta-member" class="btn-primary btn-xl">
                        Become a Member
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}" id="hero-cta-services" class="btn-secondary btn-xl">
                        Explore Services
                    </a>
                </div>

                {{-- Stats bar --}}
                <div class="flex flex-wrap gap-8 mt-14 pt-10 border-t border-border/60 animate-fade-up" style="animation-delay:650ms">
                    <div>
                        <p class="font-heading font-bold text-2xl text-charcoal">8+</p>
                        <p class="text-charcoal-muted text-sm">Core Concepts</p>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-2xl text-charcoal">Live</p>
                        <p class="text-charcoal-muted text-sm">Trading Sessions</p>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-2xl text-charcoal">Pro</p>
                        <p class="text-charcoal-muted text-sm">Trading Tools</p>
                    </div>
                    <div>
                        <p class="font-heading font-bold text-2xl text-charcoal">EN | മലയാളം</p>
                        <p class="text-charcoal-muted text-sm">Bilingual Content</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-float" aria-hidden="true">
            <span class="text-charcoal-muted/50 text-xs font-body tracking-widest uppercase">Scroll</span>
            <div class="w-px h-10 bg-gradient-to-b from-border to-transparent"></div>
        </div>
    </section>

    {{-- ===================================================
         VISION SECTION
         =================================================== --}}
    <section id="vision" class="section section-alt" aria-label="Vision">
        <div class="container-page">
            <div class="max-w-3xl mx-auto text-center">

                <p class="section-label mb-4">{{ app()->getLocale() === 'ml' ? 'ഞങ്ങളുടെ തത്ത്വചിന്ത' : 'Our Philosophy' }}</p>

                <h2 class="section-title text-4xl lg:text-5xl mb-8 text-balance">
                    {{ app()->getLocale() === 'ml'
                        ? 'Indicators പഠിക്കുന്നവർ traders ആണ്.'
                        : 'Most traders learn indicators.' }}
                    <br>
                    <span class="text-brand">
                        {{ app()->getLocale() === 'ml'
                            ? 'Participation മനസ്സിലാക്കുന്നവർ professionals.'
                            : 'Professionals learn participation.' }}
                    </span>
                </h2>

                <p class="text-charcoal-muted text-lg leading-relaxed mb-10">
                    {{ app()->getLocale() === 'ml'
                        ? 'DomDrills institutions market-ൽ എങ്ങനെ participate ചെയ്യുന്നു എന്ന് Order Flow, Volume Profile, Options positioning, Liquidity എന്നിവയിലൂടെ പഠിപ്പിക്കുന്നു.'
                        : 'DomDrills teaches you to understand how institutions interact with the market through Order Flow, Volume Profile, Options positioning and Liquidity. Not what the market is doing — but why.' }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mt-12">
                    @foreach([
                        ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'title' => 'Structured', 'desc' => 'Curriculum designed around institutional concepts, not retail myths.'],
                        ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Educational', 'desc' => 'Deep education on market microstructure and order flow.'],
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Trustworthy', 'desc' => 'No promises of profits. No misleading performance claims.'],
                    ] as $item)
                    <div class="flex flex-col items-center text-center p-6 rounded-2xl bg-white border border-border shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                        <div class="w-11 h-11 rounded-xl bg-brand/10 flex items-center justify-center mb-4">
                            <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $item['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-heading font-semibold text-charcoal text-base mb-2">{{ $item['title'] }}</h3>
                        <p class="text-charcoal-muted text-sm leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================
         CORE TRADING CONCEPTS
         =================================================== --}}
    <section id="concepts" class="section" aria-label="Core Trading Concepts">
        <div class="container-page">

            <div class="text-center mb-14">
                <p class="section-label mb-4">{{ app()->getLocale() === 'ml' ? 'Core Concepts' : 'Core Concepts' }}</p>
                <h2 class="section-title text-4xl lg:text-5xl mb-5">
                    {{ app()->getLocale() === 'ml' ? 'Professional Trading Concepts' : 'What You Will Learn' }}
                </h2>
                <p class="section-subtitle max-w-2xl mx-auto">
                    {{ app()->getLocale() === 'ml'
                        ? 'Professional traders ഉപയോഗിക്കുന്ന tools, concepts, frameworks ഇവ DomDrills-ൽ പഠിക്കാം.'
                        : 'The tools, concepts and frameworks that professional traders use every single day.' }}
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @php
                $concepts = [
                    [
                        'name' => 'Order Flow',
                        'ml_name' => 'Order Flow',
                        'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6',
                        'en_desc' => 'See the actual buying and selling pressure in the market, trade by trade.',
                        'ml_desc' => 'Market-ൽ actual buying, selling pressure ആണ് Order Flow.',
                        'slug' => 'order-flow',
                    ],
                    [
                        'name' => 'Footprint',
                        'ml_name' => 'Footprint',
                        'icon' => 'M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2',
                        'en_desc' => 'Detailed volume at price data layered inside every candlestick.',
                        'ml_desc' => 'Candlestick-ന്റെ ഉള്ളിൽ volume at price data കാണുക.',
                        'slug' => 'footprint',
                    ],
                    [
                        'name' => 'Volume Profile',
                        'ml_name' => 'Volume Profile',
                        'icon' => 'M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z',
                        'en_desc' => 'Identify value areas, high volume nodes and price acceptance zones.',
                        'ml_desc' => 'Value areas, high volume nodes, price acceptance zones identify ചെയ്യുക.',
                        'slug' => 'volume-profile',
                    ],
                    [
                        'name' => 'Market Profile',
                        'ml_name' => 'Market Profile',
                        'icon' => 'M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'en_desc' => 'Understand auction theory, TPO structure and market balance.',
                        'ml_desc' => 'Auction theory, TPO structure, market balance മനസ്സിലാക്കുക.',
                        'slug' => 'market-profile',
                    ],
                    [
                        'name' => 'Options',
                        'ml_name' => 'Options',
                        'icon' => 'M7 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z',
                        'en_desc' => 'Options chain analysis, OI changes and smart money positioning.',
                        'ml_desc' => 'Options chain analysis, OI changes, smart money positioning.',
                        'slug' => 'options',
                    ],
                    [
                        'name' => 'Gamma / GEX',
                        'ml_name' => 'Gamma / GEX',
                        'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                        'en_desc' => 'Gamma Exposure and its impact on dealer hedging and market movement.',
                        'ml_desc' => 'Gamma Exposure dealer hedging-നെ market movement-നെ impact ചെയ്യുന്നത് മനസ്സിലാക്കുക.',
                        'slug' => 'gamma',
                    ],
                    [
                        'name' => 'Liquidity',
                        'ml_name' => 'Liquidity',
                        'icon' => 'M12 3v1m0 16v1M4.22 4.22l.707.707M18.364 18.364l.707.707M1 12h1m20 0h1M4.22 19.778l.707-.707M18.364 5.636l.707-.707',
                        'en_desc' => 'Map stop hunts, liquidity pools and institutional order placement.',
                        'ml_desc' => 'Stop hunts, liquidity pools, institutional order placement map ചെയ്യുക.',
                        'slug' => 'liquidity',
                    ],
                    [
                        'name' => 'Delta',
                        'ml_name' => 'Delta',
                        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'en_desc' => 'Cumulative Delta and aggressive buyer/seller imbalance analysis.',
                        'ml_desc' => 'Cumulative Delta, aggressive buyer/seller imbalance analysis.',
                        'slug' => 'delta',
                    ],
                ];
                @endphp

                @foreach($concepts as $i => $concept)
                <article
                    class="concept-card group"
                    style="animation-delay: {{ $i * 75 }}ms"
                    aria-label="{{ $concept['name'] }} concept"
                >
                    <div class="card-body">
                        <div class="flex items-start justify-between mb-4">
                            <div class="concept-card-icon" aria-hidden="true">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $concept['icon'] }}"/>
                                </svg>
                            </div>
                            <span class="badge-neutral text-2xs">Core</span>
                        </div>

                        <h3 class="font-heading font-bold text-charcoal text-base mb-1">{{ $concept['name'] }}</h3>

                        @if(app()->getLocale() === 'ml')
                            <p class="text-brand/70 text-xs font-body mb-2">{{ $concept['ml_name'] }} എന്താണ്?</p>
                        @endif

                        <p class="text-charcoal-muted text-sm leading-relaxed mb-4">
                            {{ app()->getLocale() === 'ml' ? $concept['ml_desc'] : $concept['en_desc'] }}
                        </p>

                        <a href="#" class="inline-flex items-center gap-1.5 text-brand text-xs font-semibold font-body group-hover:gap-2.5 transition-all duration-200" aria-label="Learn more about {{ $concept['name'] }}">
                            Learn More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================
         WHY DOMDRILLS
         =================================================== --}}
    <section id="why" class="section section-alt" aria-label="Why DomDrills">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-center">

                {{-- Left: Content --}}
                <div>
                    <p class="section-label mb-4">{{ app()->getLocale() === 'ml' ? 'എന്തുകൊണ്ട് DomDrills?' : 'Why DomDrills' }}</p>
                    <h2 class="section-title text-4xl lg:text-5xl mb-6 text-balance">
                        {{ app()->getLocale() === 'ml'
                            ? 'Trading Courses അല്ല. Professional Education.'
                            : 'Not another trading course.' }}
                    </h2>
                    <p class="text-charcoal-muted text-lg leading-relaxed mb-10">
                        {{ app()->getLocale() === 'ml'
                            ? 'DomDrills-ൽ ഞങ്ങൾ indicators, signals, tips teach ചെയ്യില്ല. Market-ൽ professionals ഏതു lens-ൽ കൂടെ നോക്കുന്നു എന്ന് ഞങ്ങൾ teach ചെയ്യുന്നു.'
                            : 'We don\'t teach you what to trade. We teach you how to think like a professional who understands markets at an institutional level.' }}
                    </p>

                    <ul class="space-y-5" role="list">
                        @foreach([
                            ['title' => 'Institutional Lens', 'desc' => 'Everything is taught from the perspective of how large institutions interact with markets.'],
                            ['title' => 'No Signal Selling', 'desc' => 'We never sell trade signals. We teach you to generate your own edge.'],
                            ['title' => 'Structured Learning', 'desc' => 'Courses are progressive — from foundational concepts to advanced execution.'],
                            ['title' => 'Bilingual Content', 'desc' => 'Full support for Malayalam speakers while keeping all trading terms in English.'],
                        ] as $point)
                        <li class="flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-brand/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-heading font-semibold text-charcoal text-sm mb-0.5">{{ $point['title'] }}</p>
                                <p class="text-charcoal-muted text-sm leading-relaxed">{{ $point['desc'] }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Right: Comparison visual --}}
                <div class="space-y-4">
                    <div class="card p-6 border-state-error/20 bg-state-error/3">
                        <p class="text-xs font-semibold text-state-error/70 uppercase tracking-widest mb-4 font-body">Typical Trading Courses</p>
                        <ul class="space-y-2.5" role="list">
                            @foreach(['Buy/Sell signals','Guaranteed profits','Indicator overload','Secret strategies','No risk education'] as $bad)
                            <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                                <svg class="w-4 h-4 text-state-error/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                {{ $bad }}
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card p-6 border-brand/20 bg-brand/3">
                        <p class="text-xs font-semibold text-brand/80 uppercase tracking-widest mb-4 font-body">DomDrills</p>
                        <ul class="space-y-2.5" role="list">
                            @foreach(['Institutional market understanding','Order Flow & Footprint mastery','Volume Profile & auction theory','Options & Gamma education','Risk-first professional approach'] as $good)
                            <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                                <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $good }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================
         SERVICES
         =================================================== --}}
    <section id="services" class="section" aria-label="Services">
        <div class="container-page">

            <div class="text-center mb-14">
                <p class="section-label mb-4">What We Offer</p>
                <h2 class="section-title text-4xl lg:text-5xl mb-5">
                    {{ app()->getLocale() === 'ml' ? 'നമ്മുടെ Services' : 'Platform Services' }}
                </h2>
                <p class="section-subtitle max-w-2xl mx-auto">
                    A complete professional trading education ecosystem inside one platform.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $services = [
                    [
                        'icon' => 'M15 10l4.553-2.069A1 1 0 0121 8.828V16a2 2 0 01-2 2H5a2 2 0 01-2-2V8.828a1 1 0 01.553-.898L8 10m7 0l-3.5-2.5L8 10m7 0v4H8v-4',
                        'title' => 'Recorded Courses',
                        'ml_title' => 'Recorded Courses',
                        'desc' => 'Structured video courses on Order Flow, Footprint, Volume Profile, Options and more. Learn at your own pace.',
                        'badge' => 'Core',
                        'badge_class' => 'badge-brand',
                    ],
                    [
                        'icon' => 'M15 10l4.553-2.069A1 1 0 0121 8.828V16a2 2 0 01-2 2H5a2 2 0 01-2-2V8.828a1 1 0 01.553-.898L8 10m7 0v4H8v-4M3 9h18',
                        'title' => 'Live Trading Sessions',
                        'ml_title' => 'Live Sessions',
                        'desc' => 'Join live market analysis sessions where we break down real market structure using professional tools.',
                        'badge' => 'Live',
                        'badge_class' => 'badge-success',
                    ],
                    [
                        'icon' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
                        'title' => 'Premium Trading Tools',
                        'ml_title' => 'Premium Tools',
                        'desc' => 'Risk Calculator, Position Sizing, Daily Levels, Market Bias tool and Trading Journal — built for professionals.',
                        'badge' => 'Premium',
                        'badge_class' => 'badge-warning',
                    ],
                    [
                        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'title' => 'Market Analysis',
                        'ml_title' => 'Market Analysis',
                        'desc' => 'Regular market analysis covering key levels, institutional flow and session context.',
                        'badge' => 'Weekly',
                        'badge_class' => 'badge-neutral',
                    ],
                    [
                        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'title' => 'Private Community',
                        'ml_title' => 'Private Community',
                        'desc' => 'A focused private community of serious traders. Discussion, analysis and peer learning.',
                        'badge' => 'Members',
                        'badge_class' => 'badge-brand',
                    ],
                ];
                @endphp

                @foreach($services as $i => $service)
                <div class="card-hover p-6 group" style="animation-delay: {{ $i * 80 }}ms">
                    <div class="flex items-start justify-between mb-5">
                        <div class="w-11 h-11 rounded-xl bg-brand/10 flex items-center justify-center group-hover:bg-brand transition-colors duration-300">
                            <svg class="w-5 h-5 text-brand group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $service['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="{{ $service['badge_class'] }}">{{ $service['badge'] }}</span>
                    </div>
                    <h3 class="font-heading font-bold text-charcoal text-lg mb-2">{{ $service['title'] }}</h3>
                    <p class="text-charcoal-muted text-sm leading-relaxed">{{ $service['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================================================
         MEMBERSHIP
         =================================================== --}}
    <section id="membership" class="section section-alt" aria-label="Membership plans">
        <div class="container-page">

            <div class="text-center mb-14">
                <p class="section-label mb-4">Membership</p>
                <h2 class="section-title text-4xl lg:text-5xl mb-5">Simple, Clear Pricing</h2>
                <p class="section-subtitle max-w-xl mx-auto">
                    One membership. Full access to all courses, live sessions, tools and community.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">

                {{-- Monthly --}}
                <div class="pricing-card p-8">
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-charcoal-muted text-sm mb-3 uppercase tracking-widest">Monthly</p>
                        <div class="flex items-baseline gap-1">
                            <span class="font-heading font-bold text-charcoal text-4xl">₹1,999</span>
                            <span class="text-charcoal-muted text-sm font-body">/month</span>
                        </div>
                        <p class="text-charcoal-muted text-xs mt-1">Billed monthly</p>
                    </div>
                    <ul class="space-y-3 mb-8" role="list">
                        @foreach(['All Recorded Courses','Live Trading Sessions','Premium Trading Tools','Private Dashboard','Community Access'] as $f)
                        <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" id="plan-monthly" class="btn-secondary w-full justify-center">Get Started</a>
                </div>

                {{-- Quarterly — Featured --}}
                <div class="pricing-card-featured p-8">
                    <div class="pricing-badge">Most Popular</div>
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-brand text-sm mb-3 uppercase tracking-widest">Quarterly</p>
                        <div class="flex items-baseline gap-1">
                            <span class="font-heading font-bold text-charcoal text-4xl">₹4,999</span>
                            <span class="text-charcoal-muted text-sm font-body">/quarter</span>
                        </div>
                        <p class="text-state-success text-xs mt-1 font-medium">Save ~17% vs monthly</p>
                    </div>
                    <ul class="space-y-3 mb-8" role="list">
                        @foreach(['All Recorded Courses','Live Trading Sessions','Premium Trading Tools','Private Dashboard','Community Access','Priority Support'] as $f)
                        <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" id="plan-quarterly" class="btn-primary w-full justify-center shadow-brand">Get Started</a>
                </div>

                {{-- Yearly --}}
                <div class="pricing-card p-8">
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-charcoal-muted text-sm mb-3 uppercase tracking-widest">Yearly</p>
                        <div class="flex items-baseline gap-1">
                            <span class="font-heading font-bold text-charcoal text-4xl">₹14,999</span>
                            <span class="text-charcoal-muted text-sm font-body">/year</span>
                        </div>
                        <p class="text-state-success text-xs mt-1 font-medium">Save ~37% vs monthly</p>
                    </div>
                    <ul class="space-y-3 mb-8" role="list">
                        @foreach(['All Recorded Courses','Live Trading Sessions','Premium Trading Tools','Private Dashboard','Community Access','Priority Support','Exclusive Workshops'] as $f)
                        <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" id="plan-yearly" class="btn-secondary w-full justify-center">Get Started</a>
                </div>
            </div>

            <p class="text-center text-charcoal-muted/70 text-xs mt-8 font-body">
                All plans include email verification and secure member access. Prices are indicative — update to reflect your actual pricing.
            </p>
        </div>
    </section>

    {{-- ===================================================
         ABOUT
         =================================================== --}}
    <section id="about" class="section" aria-label="About DomDrills">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">
                <p class="section-label mb-4">About</p>
                <h2 class="section-title text-4xl lg:text-5xl mb-8 text-balance">
                    Built for traders who want to understand markets, not just trade them.
                </h2>
                <div class="space-y-5 text-charcoal-muted text-lg leading-relaxed">
                    <p>DomDrills was built out of a belief that most retail traders are being taught the wrong things. Indicators, signals, and "setups" that work in hindsight — but fail in real markets.</p>
                    <p>The founders of DomDrills spent years studying how institutions, market makers and professional traders actually interact with price. And that lens changed everything.</p>
                    <p>Order Flow, Footprint, Volume Profile, Gamma Exposure — these are not advanced concepts reserved for institutional desks. They are frameworks that any serious trader can learn, if taught correctly.</p>
                    <p class="font-heading font-semibold text-charcoal">DomDrills exists to teach that.</p>
                </div>
                <div class="mt-10">
                    <a href="{{ route('about') }}" class="btn-outline-brand btn-lg">Read Our Full Story</a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================
         FAQ
         =================================================== --}}
    <section id="faq" class="section section-alt" aria-label="Frequently Asked Questions">
        <div class="container-page">
            <div class="max-w-3xl mx-auto">

                <div class="text-center mb-12">
                    <p class="section-label mb-4">FAQ</p>
                    <h2 class="section-title text-4xl mb-5">Common Questions</h2>
                </div>

                <div class="space-y-3" x-data="{ open: null }" role="list">
                    @php
                    $faqs = [
                        [
                            'q' => 'Is DomDrills suitable for beginners?',
                            'a' => 'DomDrills is designed for traders who are serious about understanding markets at a professional level. While some prior market knowledge is helpful, we have structured courses that introduce each concept from the ground up.',
                        ],
                        [
                            'q' => 'Do you sell trading signals?',
                            'a' => 'No. DomDrills does not sell signals, tips or calls. We teach you how to read markets professionally so that you can develop your own edge. Signal dependency is the opposite of what we stand for.',
                        ],
                        [
                            'q' => 'What tools do I need to follow the courses?',
                            'a' => 'Most concepts taught at DomDrills can be followed using platforms like Sierra Chart, Bookmap, Jigsaw, or ThinkorSwim with a Volume Profile indicator. We guide you on setup inside the courses.',
                        ],
                        [
                            'q' => 'Is the content available in Malayalam?',
                            'a' => 'Yes. DomDrills is bilingual. Marketing content and explanations are available in both English and Malayalam. Trading terminology (Order Flow, Footprint, Gamma, etc.) always remains in English.',
                        ],
                        [
                            'q' => 'Can I cancel my membership anytime?',
                            'a' => 'Yes. You can cancel your subscription at any time. Access continues until the end of your current billing period.',
                        ],
                        [
                            'q' => 'Do you guarantee profits?',
                            'a' => 'No. We do not guarantee profitability, and we never will. Trading involves substantial risk of loss. DomDrills is an educational platform only. All trading decisions remain your sole responsibility.',
                        ],
                        [
                            'q' => 'Are the live sessions recorded?',
                            'a' => 'Yes. All live sessions are recorded and made available in the member dashboard for replay within a reasonable period after the session.',
                        ],
                    ];
                    @endphp

                    @foreach($faqs as $i => $faq)
                    <div class="faq-item" role="listitem">
                        <button
                            class="faq-question"
                            @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                            :aria-expanded="open === {{ $i }}"
                            aria-controls="faq-answer-{{ $i }}"
                            id="faq-btn-{{ $i }}"
                        >
                            <span>{{ $faq['q'] }}</span>
                            <svg
                                class="w-5 h-5 text-charcoal-muted transition-transform duration-300 flex-shrink-0"
                                :class="open === {{ $i }} ? 'rotate-45' : ''"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 4v16m8-8H4"/>
                            </svg>
                        </button>
                        <div
                            id="faq-answer-{{ $i }}"
                            x-show="open === {{ $i }}"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-collapse
                            role="region"
                            :aria-labelledby="'faq-btn-{{ $i }}'"
                        >
                            <p class="faq-answer">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================
         RISK DISCLOSURE
         =================================================== --}}
    <section id="risk-disclosure" class="section" aria-label="Risk Disclosure">
        <div class="container-page">
            <div class="risk-disclosure max-w-4xl mx-auto">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-state-warning/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-state-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-heading font-bold text-charcoal text-2xl mb-1">Risk Disclosure</h2>
                        <p class="text-state-warning/80 text-sm font-body">Please read carefully before joining</p>
                    </div>
                </div>

                <div class="space-y-4 text-charcoal-muted text-sm leading-relaxed">
                    <p>Trading futures, options, equities and other financial instruments involves <strong class="text-charcoal">substantial risk of loss</strong> and is not suitable for everyone. You could lose all of your invested capital.</p>
                    <p>DomDrills is an <strong class="text-charcoal">educational platform only</strong>. We do not provide investment advice, financial advice, or trade recommendations of any kind.</p>
                    <p>We do <strong class="text-charcoal">not guarantee profitability</strong>. Past performance shown in any educational material does not guarantee future results.</p>
                    <p>Every member is <strong class="text-charcoal">solely responsible</strong> for their own trading decisions, risk management and capital. Do not trade with money you cannot afford to lose.</p>
                    <p>Before trading any financial instrument, consult with a qualified and licensed financial advisor.</p>
                </div>

                <div class="mt-6 pt-6 border-t border-state-warning/20">
                    <p class="text-charcoal-muted/60 text-xs font-body">
                        By becoming a DomDrills member you acknowledge that you have read, understood and agree to this Risk Disclosure. DomDrills is not registered as an investment advisor with any regulatory authority.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================================================
         CONTACT
         =================================================== --}}
    <section id="contact" class="section section-alt" aria-label="Contact">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start max-w-5xl mx-auto">

                <div>
                    <p class="section-label mb-4">Get in Touch</p>
                    <h2 class="section-title text-4xl mb-5">Have a question?</h2>
                    <p class="text-charcoal-muted text-lg leading-relaxed mb-8">
                        Reach out and we'll get back to you within one business day.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 text-charcoal-muted text-sm">
                            <div class="w-8 h-8 rounded-lg bg-brand/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            support@domdrills.com
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('contact.submit') }}" class="card p-8 space-y-5" aria-label="Contact form">
                    @csrf
                    @if(session('success'))
                        <div class="alert-success" role="alert">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="contact-name" class="form-label">Full Name</label>
                        <input id="contact-name" name="name" type="text" class="form-input @error('name') border-state-error @enderror" placeholder="Your name" required autocomplete="name" value="{{ old('name') }}">
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="contact-email" class="form-label">Email Address</label>
                        <input id="contact-email" name="email" type="email" class="form-input @error('email') border-state-error @enderror" placeholder="you@example.com" required autocomplete="email" value="{{ old('email') }}">
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="contact-message" class="form-label">Message</label>
                        <textarea id="contact-message" name="message" class="form-textarea @error('message') border-state-error @enderror" placeholder="How can we help?" required rows="5">{{ old('message') }}</textarea>
                        @error('message')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <button id="contact-submit" type="submit" class="btn-primary w-full justify-center">
                        Send Message
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Hero canvas animation script --}}
    @push('scripts')
    <script>
    (function () {
        const canvas = document.getElementById('hero-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        let W, H, particles = [], lines = [];
        const PARTICLE_COUNT = 60;
        const LINE_COUNT = 12;
        const BRAND = { r: 201, g: 106, b: 27 };

        function resize() {
            W = canvas.width  = canvas.offsetWidth;
            H = canvas.height = canvas.offsetHeight;
        }

        function randomBetween(a, b) { return a + Math.random() * (b - a); }

        function initParticles() {
            particles = [];
            for (let i = 0; i < PARTICLE_COUNT; i++) {
                particles.push({
                    x: randomBetween(0, W),
                    y: randomBetween(0, H),
                    r: randomBetween(1, 2.5),
                    vx: randomBetween(-0.15, 0.15),
                    vy: randomBetween(-0.08, 0.08),
                    alpha: randomBetween(0.06, 0.18),
                });
            }
        }

        function initLines() {
            lines = [];
            for (let i = 0; i < LINE_COUNT; i++) {
                lines.push({
                    x1: randomBetween(0, W),
                    y1: randomBetween(0, H),
                    x2: randomBetween(0, W),
                    y2: randomBetween(0, H),
                    vx1: randomBetween(-0.1, 0.1),
                    vy1: randomBetween(-0.06, 0.06),
                    vx2: randomBetween(-0.1, 0.1),
                    vy2: randomBetween(-0.06, 0.06),
                    alpha: randomBetween(0.04, 0.10),
                });
            }
        }

        function wrapEdge(val, max) {
            if (val < -20) return max + 20;
            if (val > max + 20) return -20;
            return val;
        }

        function draw() {
            ctx.clearRect(0, 0, W, H);

            // Draw flowing lines
            lines.forEach(l => {
                l.x1 = wrapEdge(l.x1 + l.vx1, W);
                l.y1 = wrapEdge(l.y1 + l.vy1, H);
                l.x2 = wrapEdge(l.x2 + l.vx2, W);
                l.y2 = wrapEdge(l.y2 + l.vy2, H);

                const grad = ctx.createLinearGradient(l.x1, l.y1, l.x2, l.y2);
                grad.addColorStop(0, `rgba(${BRAND.r},${BRAND.g},${BRAND.b},0)`);
                grad.addColorStop(0.5, `rgba(${BRAND.r},${BRAND.g},${BRAND.b},${l.alpha})`);
                grad.addColorStop(1, `rgba(${BRAND.r},${BRAND.g},${BRAND.b},0)`);
                ctx.beginPath();
                ctx.moveTo(l.x1, l.y1);
                ctx.lineTo(l.x2, l.y2);
                ctx.strokeStyle = grad;
                ctx.lineWidth = 0.75;
                ctx.stroke();
            });

            // Draw particles
            particles.forEach(p => {
                p.x = wrapEdge(p.x + p.vx, W);
                p.y = wrapEdge(p.y + p.vy, H);
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(${BRAND.r},${BRAND.g},${BRAND.b},${p.alpha})`;
                ctx.fill();
            });

            requestAnimationFrame(draw);
        }

        resize();
        initParticles();
        initLines();
        draw();

        window.addEventListener('resize', () => {
            resize();
            initParticles();
            initLines();
        });
    })();
    </script>
    @endpush
</x-layouts.public>
