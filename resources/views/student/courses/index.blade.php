<x-layouts.student>
    <x-slot name="title">Courses</x-slot>
    <x-slot name="pageTitle">Courses</x-slot>

    <div class="mb-8">
        <h1 class="font-heading font-bold text-2xl text-charcoal mb-2">All Courses</h1>
        <p class="text-charcoal-muted text-sm">Browse your available courses.</p>
    </div>

    @if($courses->isEmpty())
        <div class="card p-12 text-center">
            <div class="w-14 h-14 rounded-2xl bg-brand/8 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-brand/60" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <p class="font-heading font-semibold text-charcoal mb-2">No courses available yet</p>
            <p class="text-charcoal-muted text-sm">Courses will appear here once they are published.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($courses as $course)
            <a href="{{ route('student.courses.show', $course->slug) }}" class="card-hover p-5 group block">
                <h3 class="font-heading font-semibold text-charcoal text-base mb-2">{{ $course->title }}</h3>
                <p class="text-charcoal-muted text-sm mb-4 line-clamp-2">{{ $course->description }}</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 0%"></div>
                </div>
                <p class="text-charcoal-muted text-xs mt-2">0% complete</p>
            </a>
            @endforeach
        </div>
    @endif
</x-layouts.student>
