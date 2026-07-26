<x-layouts.guest>
    <x-slot name="title">Reset Password</x-slot>

    <div class="mb-8">
        <div class="w-12 h-12 rounded-2xl bg-brand/10 flex items-center justify-center mb-5">
            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
            </svg>
        </div>
        <h1 class="font-heading font-bold text-3xl text-charcoal mb-2">Forgot your password?</h1>
        <p class="text-charcoal-muted text-sm leading-relaxed">
            Enter your email address and we'll send you a secure link to reset your password.
        </p>
    </div>

    @if(session('status'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input
                id="email"
                name="email"
                type="email"
                class="form-input @error('email') border-state-error @enderror"
                placeholder="you@example.com"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
            >
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <button id="forgot-submit" type="submit" class="btn-primary w-full justify-center btn-lg">
            Send Reset Link
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm text-charcoal-muted hover:text-charcoal transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            Back to sign in
        </a>
    </div>
</x-layouts.guest>
