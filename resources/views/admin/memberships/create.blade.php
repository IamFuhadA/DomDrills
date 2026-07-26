<x-layouts.admin>
    <x-slot name="title">Create Membership Plan</x-slot>
    <x-slot name="pageTitle">Create Plan</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.memberships.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Tiers
        </a>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-bold text-lg text-charcoal mb-5">Plan Details</h2>
            
            <form method="POST" action="{{ route('admin.memberships.store') }}" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Plan Name</label>
                    <input id="name" name="name" type="text" class="form-input @error('name') border-state-error @enderror" value="{{ old('name') }}" placeholder="e.g. Premium Yearly Access" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="price" class="form-label">Price (INR ₹)</label>
                        <input id="price" name="price" type="number" step="0.01" class="form-input @error('price') border-state-error @enderror" value="{{ old('price') }}" placeholder="e.g. 14999.00" required>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="billing_period" class="form-label">Billing Period</label>
                        <select id="billing_period" name="billing_period" class="form-input" required>
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Plan Description</label>
                    <textarea id="description" name="description" class="form-textarea" rows="3" placeholder="Provide a brief summary of this plan..." required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="features_raw" class="form-label">Features / Perks (One per line)</label>
                    <p class="text-charcoal-muted text-2xs mb-2">Write down each feature on a new line. These will appear as bullet points.</p>
                    <textarea id="features_raw" name="features_raw" class="form-textarea font-sans text-sm" rows="6" placeholder="All Recorded Courses&#10;Live Trading Sessions&#10;Premium Trading Tools" required>{{ old('features_raw') }}</textarea>
                </div>

                <button type="submit" class="btn-primary">Create Plan</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
