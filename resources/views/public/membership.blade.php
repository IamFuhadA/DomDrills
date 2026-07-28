<x-layouts.public>
    <x-slot name="title">Membership</x-slot>
    <section class="section">
        <div class="container-page">
            <div class="text-center mb-14">
                <p class="section-label mb-4">Membership</p>
                <h1 class="section-title text-4xl lg:text-5xl mb-5">Simple, Clear Pricing</h1>
                <p class="section-subtitle max-w-xl mx-auto">One membership. Full access to all courses, live sessions, tools and community.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="pricing-card p-8">
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-charcoal-muted text-sm mb-3 uppercase tracking-widest">Monthly</p>
                        <div class="flex items-baseline gap-1"><span class="font-heading font-bold text-charcoal text-4xl">₹1,999</span><span class="text-charcoal-muted text-sm font-body">/month</span></div>
                        <p class="text-charcoal-muted text-xs mt-1">Billed monthly</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach(['All Recorded Courses','Live Trading Sessions','Premium Trading Tools','Private Dashboard','Community Access'] as $f)
                        <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>{{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="btn-secondary w-full justify-center">Get Started</a>
                </div>
                <div class="pricing-card-featured p-8">
                    <div class="pricing-badge">Most Popular</div>
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-brand text-sm mb-3 uppercase tracking-widest">Quarterly</p>
                        <div class="flex items-baseline gap-1"><span class="font-heading font-bold text-charcoal text-4xl">₹4,999</span><span class="text-charcoal-muted text-sm font-body">/quarter</span></div>
                        <p class="text-state-success text-xs mt-1 font-medium">Save ~17% vs monthly</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach(['All Recorded Courses','Live Trading Sessions','Premium Trading Tools','Private Dashboard','Community Access','Priority Support'] as $f)
                        <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>{{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="btn-primary w-full justify-center shadow-brand">Get Started</a>
                </div>
                <div class="pricing-card p-8">
                    <div class="mb-6">
                        <p class="font-heading font-semibold text-charcoal-muted text-sm mb-3 uppercase tracking-widest">Yearly</p>
                        <div class="flex items-baseline gap-1"><span class="font-heading font-bold text-charcoal text-4xl">₹14,999</span><span class="text-charcoal-muted text-sm font-body">/year</span></div>
                        <p class="text-state-success text-xs mt-1 font-medium">Save ~37% vs monthly</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach(['All Recorded Courses','Live Trading Sessions','Premium Trading Tools','Private Dashboard','Community Access','Priority Support','Exclusive Workshops'] as $f)
                        <li class="flex items-center gap-3 text-sm text-charcoal-muted">
                            <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>{{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="btn-secondary w-full justify-center">Get Started</a>
                </div>
            </div>

            <x-caution-message class="mt-12 max-w-5xl mx-auto" />
        </div>
    </section>
</x-layouts.public>
