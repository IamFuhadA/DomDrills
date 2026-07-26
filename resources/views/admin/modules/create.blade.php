<x-layouts.admin>
    <x-slot name="title">Add Module — {{ $course->title }}</x-slot>
    <x-slot name="pageTitle">Add Module</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.courses.show', $course->id) }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Syllabus
        </a>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-semibold text-charcoal text-base mb-5">Module Details</h2>
            
            <form method="POST" action="{{ route('admin.courses.modules.store', $course->id) }}" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label">Module Title</label>
                    <input id="title" name="title" type="text" class="form-input @error('title') border-state-error @enderror" value="{{ old('title') }}" placeholder="e.g. Introduction to Auction Theory" required>
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea id="description" name="description" class="form-textarea" rows="3" placeholder="Provide a brief summary of this module's topics...">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="order" class="form-label">Sort Order</label>
                    <input id="order" name="order" type="number" class="form-input" value="{{ old('order', 1) }}" required>
                </div>

                <button type="submit" class="btn-primary">Create Module</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
