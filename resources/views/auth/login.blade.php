<x-layouts.guest>
    <x-slot name="title">Sign In</x-slot>

    {{-- Heading --}}
    <div class="mb-8">
        <h1 class="font-heading font-bold text-3xl text-charcoal mb-2">Welcome back</h1>
        <p class="text-charcoal-muted text-sm">Sign in to your DomDrills account</p>
    </div>

    {{-- Session Status --}}
    @if(session('status'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div class="form-group">
            <label for="email" class="form-label">Email or Login ID</label>
            <input
                id="email"
                name="email"
                type="text"
                class="form-input @error('email') border-state-error focus:ring-state-error/30 @enderror"
                placeholder="you@example.com or DOM1001"
                value="{{ old('email') }}"
                required
                autofocus
            >
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="form-label">Password</label>
                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-brand hover:text-brand-hover font-medium transition-colors duration-200">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative" x-data="{ show: false }">
                <input
                    id="password"
                    name="password"
                    :type="show ? 'text' : 'password'"
                    class="form-input pr-11 @error('password') border-state-error @enderror"
                    placeholder="Your password"
                    required
                    autocomplete="current-password"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-charcoal-muted/60 hover:text-charcoal-muted transition-colors duration-200"
                    :aria-label="show ? 'Hide password' : 'Show password'"
                >
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center gap-3">
            <input
                id="remember_me"
                name="remember"
                type="checkbox"
                class="w-4 h-4 rounded border-border text-brand focus:ring-brand/30 cursor-pointer"
            >
            <label for="remember_me" class="text-sm text-charcoal-muted cursor-pointer select-none">
                Remember me for 30 days
            </label>
        </div>

        {{-- Submit --}}
        <button id="login-submit" type="submit" class="btn-primary w-full justify-center btn-lg">
            Sign In
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </button>
    </form>

    {{-- Divider --}}
    <div class="divider my-7">or</div>

    {{-- Register link --}}
    <p class="text-center text-sm text-charcoal-muted">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-brand font-semibold hover:text-brand-hover transition-colors duration-200 ml-1">
            Create account
        </a>
    </p>

    {{-- Risk notice --}}
    <p class="text-center text-charcoal-muted/50 text-2xs mt-8 leading-relaxed">
        By signing in you acknowledge our <a href="{{ route('risk-disclosure') }}" class="underline underline-offset-2 hover:text-charcoal-muted/80">Risk Disclosure</a> and <a href="{{ route('terms') }}" class="underline underline-offset-2 hover:text-charcoal-muted/80">Terms of Service</a>.
    </p>
</x-layouts.guest>
