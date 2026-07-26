<x-layouts.admin>
    <x-slot name="title">Edit Plan — {{ $plan->name }}</x-slot>
    <x-slot name="pageTitle">Edit Plan</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.memberships.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Tiers
        </a>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-bold text-lg text-charcoal mb-5">Plan Details</h2>
            
            <form method="POST" action="{{ route('admin.memberships.update', $plan->id) }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="form-label">Plan Name</label>
                    <input id="name" name="name" type="text" class="form-input @error('name') border-state-error @enderror" value="{{ old('name', $plan->name) }}" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="price" class="form-label">Price (INR ₹)</label>
                        <input id="price" name="price" type="number" step="0.01" class="form-input @error('price') border-state-error @enderror" value="{{ old('price', $plan->price) }}" required>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="billing_period" class="form-label">Billing Period</label>
                        <select id="billing_period" name="billing_period" class="form-input" required>
                            <option value="monthly" {{ $plan->billing_period === 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="quarterly" {{ $plan->billing_period === 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                            <option value="yearly" {{ $plan->billing_period === 'yearly' ? 'selected' : '' }}>Yearly</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Plan Description</label>
                    <textarea id="description" name="description" class="form-textarea" rows="3" required>{{ old('description', $plan->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="features_raw" class="form-label">Features / Perks (One per line)</label>
                    <p class="text-charcoal-muted text-2xs mb-2">Write down each feature on a new line. These will appear as bullet points.</p>
                    <textarea id="features_raw" name="features_raw" class="form-textarea font-sans text-sm" rows="6" required>{{ old('features_raw', implode("\n", $plan->features ?? [])) }}</textarea>
                </div>

                <button type="submit" class="btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
