<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModuleController extends Controller
{
    public function create(Course $course): View
    {
        return view('admin.modules.create', compact('course'));
    }

    public function store(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['required', 'integer'],
        ]);

        $course->modules()->create($validated);

        return redirect()->route('admin.courses.show', $course)->with('success', 'Module created successfully.');
    }

    public function edit(Module $module): View
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'order' => ['required', 'integer'],
        ]);

        $module->update($validated);

        return redirect()->route('admin.courses.show', $module->course_id)->with('success', 'Module updated successfully.');
    }

    public function destroy(Module $module): RedirectResponse
    {
        $courseId = $module->course_id;
        $module->delete();

        return redirect()->route('admin.courses.show', $courseId)->with('success', 'Module deleted successfully.');
    }
}
