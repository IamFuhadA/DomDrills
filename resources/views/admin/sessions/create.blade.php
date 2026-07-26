<x-layouts.admin>
    <x-slot name="title">Schedule Session</x-slot>
    <x-slot name="pageTitle">Schedule Session</x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.sessions.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to Sessions
        </a>
    </div>

    <div class="card max-w-2xl">
        <div class="card-body">
            <h2 class="font-heading font-semibold text-charcoal text-base mb-5">Webinar Details</h2>
            
            <form method="POST" action="{{ route('admin.sessions.store') }}" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label for="title" class="form-label">Session Title</label>
                    <input id="title" name="title" type="text" class="form-input @error('title') border-state-error @enderror" value="{{ old('title') }}" placeholder="e.g. Nifty Live Order Flow Trading" required>
                    @error('title')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description Summary</label>
                    <textarea id="description" name="description" class="form-textarea" rows="4" placeholder="Mention key topics, profile setups to monitor..." required>{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="scheduled_at" class="form-label">Scheduled Time (IST)</label>
                        <input id="scheduled_at" name="scheduled_at" type="datetime-local" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="duration_minutes" class="form-label">Duration (Minutes)</label>
                        <input id="duration_minutes" name="duration_minutes" type="number" class="form-input" value="60" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="meeting_link" class="form-label">Zoom/Meeting Link (Optional)</label>
                        <input id="meeting_link" name="meeting_link" type="url" class="form-input" placeholder="https://zoom.us/j/...">
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-input">
                            <option value="scheduled">Scheduled</option>
                            <option value="live">Live Now</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-primary">Schedule Session</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
