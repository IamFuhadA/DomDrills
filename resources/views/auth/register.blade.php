<x-layouts.guest>
    <x-slot name="title">Create Account</x-slot>

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="font-heading font-bold text-3xl text-charcoal mb-2">Create your account</h1>
        <p class="text-charcoal-muted text-sm">Join DomDrills. Start learning how professionals read markets.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Full Name --}}
        <div class="form-group">
            <label for="name" class="form-label">Full Name</label>
            <input
                id="name"
                name="name"
                type="text"
                class="form-input @error('name') border-state-error @enderror"
                placeholder="Your full name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
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
                autocomplete="username"
            >
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="relative" x-data="{ show: false }">
                <input
                    id="password"
                    name="password"
                    :type="show ? 'text' : 'password'"
                    class="form-input pr-11 @error('password') border-state-error @enderror"
                    placeholder="Minimum 8 characters"
                    required
                    autocomplete="new-password"
                >
                <button type="button" @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-charcoal-muted/60 hover:text-charcoal-muted transition-colors duration-200"
                    :aria-label="show ? 'Hide password' : 'Show password'">
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
            <p class="form-hint">Use at least 8 characters with a mix of letters and numbers.</p>
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-input"
                placeholder="Repeat your password"
                required
                autocomplete="new-password"
            >
            @error('password_confirmation')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Terms & Risk Disclosure --}}
        <div class="space-y-2.5">
            <label class="flex items-start gap-3 cursor-pointer">
                <input
                    id="terms"
                    name="terms"
                    type="checkbox"
                    class="w-4 h-4 mt-0.5 rounded border-border text-brand focus:ring-brand/30 cursor-pointer flex-shrink-0"
                    required
                >
                <span class="text-xs text-charcoal-muted leading-relaxed">
                    I agree to the
                    <a href="{{ route('terms') }}" class="text-brand hover:text-brand-hover font-medium" target="_blank">Terms of Service</a>
                    and
                    <a href="{{ route('risk-disclosure') }}" class="text-brand hover:text-brand-hover font-medium" target="_blank">Risk Disclosure</a>
                </span>
            </label>

            <label class="flex items-start gap-3 cursor-pointer">
                <input
                    id="risk"
                    name="risk_acknowledged"
                    type="checkbox"
                    class="w-4 h-4 mt-0.5 rounded border-border text-brand focus:ring-brand/30 cursor-pointer flex-shrink-0"
                    required
                >
                <span class="text-xs text-charcoal-muted leading-relaxed">
                    I understand that DomDrills is an <strong class="text-charcoal">educational platform only</strong> and does not provide financial advice or guarantee profitability
                </span>
            </label>
        </div>

        {{-- Submit --}}
        <button id="register-submit" type="submit" class="btn-primary w-full justify-center btn-lg">
            Create Account
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    {{-- Divider --}}
    <div class="divider my-7">or</div>

    {{-- Login link --}}
    <p class="text-center text-sm text-charcoal-muted">
        Already have an account?
        <a href="{{ route('login') }}" class="text-brand font-semibold hover:text-brand-hover transition-colors duration-200 ml-1">
            Sign in
        </a>
    </p>
</x-layouts.guest>
