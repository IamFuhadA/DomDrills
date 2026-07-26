<x-layouts.student>
    <x-slot name="title">{{ $course->title }}</x-slot>
    <x-slot name="pageTitle">Course Details</x-slot>

    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('student.courses.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to all courses
        </a>
    </div>

    {{-- Course Header --}}
    <div class="card mb-8">
        <div class="card-body">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center">
                <div class="flex-1">
                    <h1 class="font-heading font-bold text-2xl lg:text-3xl text-charcoal mb-3">{{ $course->title }}</h1>
                    <p class="text-charcoal-muted text-sm leading-relaxed max-w-3xl mb-4">{{ $course->description }}</p>
                    <div class="flex flex-wrap items-center gap-4 text-xs text-charcoal-muted">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            {{ $course->modules->count() }} Modules
                        </span>
                        <span class="w-1.5 h-1.5 rounded-full bg-border"></span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            {{ $course->lessons->count() }} Lessons
                        </span>
                    </div>
                </div>
                @if($course->lessons->count() > 0)
                    @php
                        $firstLesson = $course->lessons->first();
                    @endphp
                    <a href="{{ route('student.lessons.show', $firstLesson->slug) }}" class="btn-primary btn-lg shadow-brand w-full lg:w-auto justify-center">
                        Start Course
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Curriculum Hierarchy --}}
    <div class="max-w-4xl space-y-6">
        <h2 class="font-heading font-bold text-charcoal text-xl">Course Curriculum</h2>

        @if($course->modules->isEmpty())
            <div class="card p-8 text-center text-charcoal-muted text-sm">No curriculum has been uploaded for this course yet.</div>
        @else
            @foreach($course->modules as $index => $module)
            <div class="card" x-data="{ open: true }">
                <div class="px-6 py-5 border-b border-border bg-ivory-alt/30 flex items-center justify-between cursor-pointer" @click="open = !open">
                    <div>
                        <p class="text-brand text-2xs font-semibold uppercase tracking-wide mb-1">Module {{ $index + 1 }}</p>
                        <h3 class="font-heading font-semibold text-charcoal text-base">{{ $module->title }}</h3>
                        @if($module->description)
                            <p class="text-charcoal-muted text-xs mt-1">{{ $module->description }}</p>
                        @endif
                    </div>
                    <button class="p-1 rounded-lg hover:bg-border transition-colors duration-200" aria-label="Toggle module content">
                        <svg class="w-5 h-5 text-charcoal-muted transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>

                <div x-show="open" x-collapse>
                    <div class="divide-y divide-border">
                        @if($module->lessons->isEmpty())
                            <div class="px-6 py-4 text-center text-charcoal-muted text-xs">No lessons in this module.</div>
                        @else
                            @foreach($module->lessons as $lesson)
                            <div class="px-6 py-4.5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-ivory transition-colors duration-200">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="w-5 h-5 rounded-full bg-brand/10 text-brand text-2xs font-semibold flex items-center justify-center flex-shrink-0">
                                            {{ $lesson->order }}
                                        </span>
                                        <h4 class="font-medium text-charcoal text-sm">{{ $lesson->title }}</h4>
                                    </div>
                                    <p class="text-charcoal-muted text-xs pl-7 line-clamp-2">{{ $lesson->description }}</p>
                                </div>
                                <div class="flex items-center gap-4 pl-7 sm:pl-0 flex-shrink-0">
                                    <span class="text-charcoal-muted text-xs flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $lesson->duration_minutes }}m
                                    </span>
                                    @if($lesson->isCompletedBy(auth()->user()))
                                        <span class="badge-success">Completed</span>
                                    @endif
                                    <a href="{{ route('student.lessons.show', $lesson->slug) }}" class="btn-outline-brand btn-sm">
                                        Watch
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</x-layouts.student>
