<x-layouts.student>
    <x-slot name="title">Trading Tools</x-slot>
    <x-slot name="pageTitle">Trading Tools</x-slot>

    <div class="mb-8">
        <h1 class="font-heading font-bold text-2xl text-charcoal mb-2">Trading Tools</h1>
        <p class="text-charcoal-muted text-sm">Professional tools for serious traders.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
        @foreach([
            ['slug' => 'risk-calculator',      'title' => 'Risk Calculator',          'desc' => 'Calculate your risk per trade based on account size and stop-loss distance.',      'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M4 19h16a1 1 0 001-1V6a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1z'],
            ['slug' => 'position-size',         'title' => 'Position Size Calculator', 'desc' => 'Calculate optimal position size based on risk tolerance and account parameters.', 'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'],
            ['slug' => 'daily-levels',          'title' => 'Daily Levels',             'desc' => 'Key price levels for the session — VWAP, POC, VAH, VAL and support/resistance.', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
            ['slug' => 'market-bias',           'title' => 'Market Bias',              'desc' => 'Daily market bias indicator based on structure, volume and auction context.',       'icon' => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z'],
            ['slug' => 'trading-journal',       'title' => 'Trading Journal',          'desc' => 'Log and review your trades with structured notes, screenshots and analytics.',    'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
            ['slug' => 'session-notes',         'title' => 'Session Notes',            'desc' => 'Pre-session and post-session note templates for structured market analysis.',      'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
        ] as $tool)
        <a href="{{ route('student.tools.show', $tool['slug']) }}" class="card-hover p-6 group block">
            <div class="w-10 h-10 rounded-xl bg-brand/10 flex items-center justify-center mb-4 group-hover:bg-brand transition-colors duration-300">
                <svg class="w-5 h-5 text-brand group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="{{ $tool['icon'] }}"/>
                </svg>
            </div>
            <h3 class="font-heading font-semibold text-charcoal text-base mb-2">{{ $tool['title'] }}</h3>
            <p class="text-charcoal-muted text-sm leading-relaxed">{{ $tool['desc'] }}</p>
        </a>
        @endforeach
    </div>
</x-layouts.student>
