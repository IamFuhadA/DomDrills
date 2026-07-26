<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function create(Module $module): View
    {
        return view('admin.lessons.create', compact('module'));
    }

    public function store(Request $request, Module $module): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'order' => ['required', 'integer'],
            'duration_minutes' => ['required', 'integer', 'min:0'],
        ]);

        $validated['slug'] = str($validated['title'])->slug();

        $module->lessons()->create($validated);

        return redirect()->route('admin.courses.show', $module->course_id)->with('success', 'Lesson created successfully.');
    }

    public function edit(Lesson $lesson): View
    {
        return view('admin.lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'order' => ['required', 'integer'],
            'duration_minutes' => ['required', 'integer', 'min:0'],
        ]);

        $validated['slug'] = str($validated['title'])->slug();

        $lesson->update($validated);

        return redirect()->route('admin.courses.show', $lesson->module->course_id)->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson): RedirectResponse
    {
        $courseId = $lesson->module->course_id;
        $lesson->delete();

        return redirect()->route('admin.courses.show', $courseId)->with('success', 'Lesson deleted successfully.');
    }
}
