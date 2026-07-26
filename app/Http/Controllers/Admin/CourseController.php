<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::orderBy('order')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.courses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'published' => ['boolean'],
            'order' => ['integer'],
        ]);

        $validated['slug'] = str($validated['title'])->slug();
        $validated['published'] = $request->has('published');

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function show(Course $course): View
    {
        $course->load('modules.lessons');
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'published' => ['boolean'],
            'order' => ['integer'],
        ]);

        $validated['slug'] = str($validated['title'])->slug();
        $validated['published'] = $request->has('published');

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
