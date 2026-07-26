<x-layouts.admin>
    <x-slot name="title">Courses Management</x-slot>
    <x-slot name="pageTitle">Courses</x-slot>

    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="font-heading font-bold text-2xl text-charcoal">Course Catalog</h1>
            <p class="text-charcoal-muted text-xs">Manage educational tracks, modules, lessons and video resources.</p>
        </div>
        <a href="{{ route('admin.courses.create') }}" class="btn-primary btn-sm flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Create Course
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success mb-6" role="alert">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="card overflow-hidden">
        @if($courses->isEmpty())
            <div class="p-12 text-center text-charcoal-muted text-sm">
                No courses created yet. Get started by clicking "Create Course".
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table-base">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Modules</th>
                            <th>Lessons</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td class="text-xs text-charcoal-muted font-bold">#{{ $course->order }}</td>
                            <td class="font-semibold text-charcoal text-sm">
                                <a href="{{ route('admin.courses.show', $course) }}" class="hover:text-brand transition-colors">{{ $course->title }}</a>
                            </td>
                            <td>
                                @if($course->published)
                                    <span class="badge-success">Published</span>
                                @else
                                    <span class="badge-warning">Draft</span>
                                @endif
                            </td>
                            <td class="text-xs text-charcoal-muted">{{ $course->modules->count() }}</td>
                            <td class="text-xs text-charcoal-muted">{{ $course->lessons->count() }}</td>
                            <td class="text-right space-x-2">
                                <a href="{{ route('admin.courses.show', $course) }}" class="text-brand text-xs font-semibold hover:text-brand-hover">View / Edit Syllabus</a>
                                <span class="text-border">|</span>
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-charcoal-muted text-xs font-semibold hover:text-charcoal">Edit Info</a>
                                <span class="text-border">|</span>
                                <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-state-error/80 text-xs font-semibold hover:text-state-error">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.admin>
