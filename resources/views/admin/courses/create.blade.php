<x-layouts.admin>
    <x-slot name="title">Create Course</x-slot>
    <x-slot name="pageTitle">Create Course</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Catalog
        </a>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-bold text-lg text-charcoal mb-5">Course Details</h2>
            
            <form method="POST" action="{{ route('admin.courses.store') }}" class="space-y-5">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label">Course Title</label>
                    <input id="title" name="title" type="text" class="form-input @error('title') border-state-error @enderror" value="{{ old('title') }}" placeholder="e.g. Footprint Charts Mastery" required>
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-textarea @error('description') border-state-error @enderror" placeholder="Provide a summary of what students will learn..." rows="5" required>{{ old('description') }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="order" class="form-label">Catalog Sort Order</label>
                        <input id="order" name="order" type="number" class="form-input" value="{{ old('order', 0) }}" required>
                    </div>

                    <div class="flex items-center gap-3 pt-6">
                        <input id="published" name="published" type="checkbox" value="1" class="w-4 h-4 rounded border-border text-brand focus:ring-brand/30 cursor-pointer">
                        <label for="published" class="text-sm font-medium text-charcoal cursor-pointer">Publish Immediately</label>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Create Course</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
