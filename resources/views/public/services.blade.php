<x-layouts.public>
    <x-slot name="title">Services</x-slot>
    <x-slot name="description">DomDrills offers recorded courses, live trading sessions, premium tools, market analysis and a private community for serious traders.</x-slot>

    <section class="section">
        <div class="container-page">
            <div class="text-center mb-14">
                <p class="section-label mb-4">What We Offer</p>
                <h1 class="section-title text-4xl lg:text-5xl mb-5">Platform Services</h1>
                <p class="section-subtitle max-w-2xl mx-auto">
                    A complete professional trading education ecosystem inside one platform.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                @foreach([
                    ['title' => 'Recorded Courses', 'desc' => 'Structured video courses on Order Flow, Footprint, Volume Profile, Options and more. Progressive curriculum from fundamentals to advanced execution.', 'icon' => 'M15 10l4.553-2.069A1 1 0 0121 8.828V16a2 2 0 01-2 2H5a2 2 0 01-2-2V8.828a1 1 0 01.553-.898L8 10m7 0l-3.5-2.5L8 10m7 0v4H8v-4'],
                    ['title' => 'Live Trading Sessions', 'desc' => 'Join live market analysis sessions where we break down real market structure, order flow and volume profile using professional tools.', 'icon' => 'M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z'],
                    ['title' => 'Premium Trading Tools', 'desc' => 'Professional-grade tools built for DomDrills members: Risk Calculator, Position Sizing, Daily Levels, Market Bias and Trading Journal.', 'icon' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z'],
                    ['title' => 'Market Analysis', 'desc' => 'Regular published market analysis covering key volume profile levels, institutional flow context and session preparation notes.', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                    ['title' => 'Private Community', 'desc' => 'A focused community of serious traders. No noise, no signal-selling. Just structured discussion, peer learning and market analysis.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ] as $s)
                <div class="card p-8">
                    <div class="w-11 h-11 rounded-xl bg-brand/10 flex items-center justify-center mb-5">
                        <svg class="w-5 h-5 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>
                    <h2 class="font-heading font-bold text-charcoal text-xl mb-3">{{ $s['title'] }}</h2>
                    <p class="text-charcoal-muted text-sm leading-relaxed">{{ $s['desc'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="btn-primary btn-xl">Become a Member</a>
            </div>
        </div>
    </section>
</x-layouts.public>
