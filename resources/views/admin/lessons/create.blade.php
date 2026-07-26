<x-layouts.admin>
    <x-slot name="title">Add Lesson — {{ $module->title }}</x-slot>
    <x-slot name="pageTitle">Add Lesson</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.courses.show', $module->course_id) }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Syllabus
        </a>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-semibold text-charcoal text-base mb-5">Lesson Details</h2>
            
            <form method="POST" action="{{ route('admin.modules.lessons.store', $module->id) }}" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label">Lesson Title</label>
                    <input id="title" name="title" type="text" class="form-input @error('title') border-state-error @enderror" value="{{ old('title') }}" placeholder="e.g. Understanding Bid/Ask Spread Dynamics" required>
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Brief Description</label>
                    <textarea id="description" name="description" class="form-textarea" rows="3" placeholder="Provide a summary of this lesson..."></textarea>
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Syllabus & Notes Content</label>
                    <textarea id="content" name="content" class="form-textarea font-mono text-xs" rows="8" placeholder="Write down markdown/plain text notes for the lesson..."></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="duration_minutes" class="form-label">Duration (Minutes)</label>
                        <input id="duration_minutes" name="duration_minutes" type="number" class="form-input" value="{{ old('duration_minutes', 0) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="order" class="form-label">Sort Order</label>
                        <input id="order" name="order" type="number" class="form-input" value="{{ old('order', 1) }}" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Create Lesson</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
