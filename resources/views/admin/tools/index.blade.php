<x-layouts.admin>
    <x-slot name="title">Trading Tools Management</x-slot>
    <x-slot name="pageTitle">Trading Tools</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="font-heading font-bold text-2xl text-charcoal">Trading Tools Catalog</h1>
            <p class="text-charcoal-muted text-xs">Configure status parameters for student calculators, templates and journals.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @foreach([
            ['title' => 'Risk Calculator', 'slug' => 'risk-calculator', 'status' => true],
            ['title' => 'Position Size Calculator', 'slug' => 'position-size', 'status' => true],
            ['title' => 'Daily Levels', 'slug' => 'daily-levels', 'status' => true],
            ['title' => 'Market Bias Evaluator', 'slug' => 'market-bias', 'status' => true],
            ['title' => 'Trading Journal', 'slug' => 'trading-journal', 'status' => true],
            ['title' => 'Session Notes Template', 'slug' => 'session-notes', 'status' => true],
        ] as $tool)
        <div class="card p-5 flex items-center justify-between">
            <div>
                <h3 class="font-heading font-semibold text-charcoal text-base">{{ $tool['title'] }}</h3>
                <code class="text-[10px] text-charcoal-muted font-mono">slug: {{ $tool['slug'] }}</code>
            </div>
            <div class="flex items-center gap-2">
                <span class="badge-success">Active</span>
                <button class="text-xs text-brand font-semibold hover:text-brand-hover ml-3">Configure</button>
            </div>
        </div>
        @endforeach
    </div>
</x-layouts.admin>
