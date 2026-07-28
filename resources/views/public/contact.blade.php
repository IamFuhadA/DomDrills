<x-layouts.public>
    <x-slot name="title">Contact</x-slot>
    <section class="section">
        <div class="container-page">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start max-w-5xl mx-auto">
                <div>
                    <p class="section-label mb-4">Get in Touch</p>
                    <h1 class="section-title text-4xl mb-5">Have a question?</h1>
                    <p class="text-charcoal-muted text-lg leading-relaxed mb-8">Reach out and we'll respond within one business day.</p>
                    <div class="flex items-center gap-3 text-charcoal-muted text-sm mb-6">
                        <div class="w-8 h-8 rounded-lg bg-brand/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        support@domdrills.com
                    </div>

                    <x-caution-message />
                </div>
                <form method="POST" action="{{ route('contact.submit') }}" class="card p-8 space-y-5" aria-label="Contact form">
                    @csrf
                    @if(session('success'))
                        <div class="alert-success" role="alert">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="contact-name" class="form-label">Full Name</label>
                        <input id="contact-name" name="name" type="text" class="form-input @error('name') border-state-error @enderror" placeholder="Your name" required value="{{ old('name') }}">
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label for="contact-email" class="form-label">Email Address</label>
                        <input id="contact-email" name="email" type="email" class="form-input @error('email') border-state-error @enderror" placeholder="you@example.com" required value="{{ old('email') }}">
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label for="contact-message" class="form-label">Message</label>
                        <textarea id="contact-message" name="message" class="form-textarea @error('message') border-state-error @enderror" placeholder="How can we help?" required rows="5">{{ old('message') }}</textarea>
                        @error('message')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <button id="contact-submit" type="submit" class="btn-primary w-full justify-center">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.public>
