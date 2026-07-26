<x-layouts.admin>
    <x-slot name="title">{{ $course->title }} — Syllabus</x-slot>
    <x-slot name="pageTitle">Syllabus Builder</x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <a href="{{ route('admin.courses.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
                Back to Catalog
            </a>
            <h1 class="font-heading font-bold text-2xl text-charcoal">{{ $course->title }}</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.courses.edit', $course) }}" class="btn-outline-brand btn-sm">Edit General Info</a>
            {{-- Quick add module form trigger or link --}}
            <a href="{{ route('admin.courses.modules.create', $course->id) }}" class="btn-primary btn-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                Add Module
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Curriculum builder --}}
    <div class="space-y-6 max-w-4xl">
        @if($course->modules->isEmpty())
            <div class="card p-12 text-center text-charcoal-muted text-sm">
                No modules created yet. Add your first module to begin structuring the syllabus.
            </div>
        @else
            @foreach($course->modules as $modIndex => $module)
            <div class="card">
                <div class="px-6 py-4.5 border-b border-border bg-ivory-alt/30 flex items-center justify-between">
                    <div>
                        <span class="text-brand text-[10px] font-semibold uppercase tracking-wider">Module {{ $modIndex + 1 }}</span>
                        <h3 class="font-heading font-semibold text-charcoal text-base mt-0.5">{{ $module->title }}</h3>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.modules.lessons.create', $module->id) }}" class="text-brand text-xs font-semibold hover:text-brand-hover flex items-center gap-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Add Lesson
                        </a>
                        <span class="text-border">|</span>
                        <a href="{{ route('admin.modules.edit', $module->id) }}" class="text-charcoal-muted text-xs hover:text-charcoal">Edit</a>
                        <span class="text-border">|</span>
                        <form method="POST" action="{{ route('admin.modules.destroy', $module->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this module and all of its lessons?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-state-error/80 text-xs hover:text-state-error">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="divide-y divide-border">
                    @if($module->lessons->isEmpty())
                        <div class="px-6 py-4 text-center text-charcoal-muted text-xs">No lessons added to this module.</div>
                    @else
                        @foreach($module->lessons as $lesson)
                        <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-ivory/50">
                            <div>
                                <h4 class="font-medium text-charcoal text-sm flex items-center gap-2">
                                    <span class="text-2xs text-charcoal-muted">#{{ $lesson->order }}</span>
                                    {{ $lesson->title }}
                                </h4>
                                <p class="text-charcoal-muted text-2xs pl-6 mt-0.5">{{ $lesson->duration_minutes }} minutes</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="text-charcoal-muted text-xs hover:text-charcoal">Edit Lesson</a>
                                <span class="text-border">|</span>
                                <form method="POST" action="{{ route('admin.lessons.destroy', $lesson->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this lesson?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-state-error/80 text-xs hover:text-state-error">Delete</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-layouts.admin>
