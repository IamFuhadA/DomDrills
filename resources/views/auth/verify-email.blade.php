<x-layouts.guest>
    <x-slot name="title">Verify Your Email</x-slot>

    <div class="text-center mb-8">
        <div class="w-16 h-16 rounded-2xl bg-brand/10 flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="font-heading font-bold text-3xl text-charcoal mb-3">Verify your email</h1>
        <p class="text-charcoal-muted text-sm leading-relaxed max-w-xs mx-auto">
            Thanks for registering. We've sent a verification link to your email address. Please check your inbox and click the link to activate your account.
        </p>
    </div>

    @if(session('status') === 'verification-link-sent')
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button id="resend-verification" type="submit" class="btn-primary w-full justify-center">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-ghost w-full justify-center text-charcoal-muted">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Sign out and use a different account
            </button>
        </form>
    </div>
</x-layouts.guest>
