<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = \App\Models\Course::where('published', true)->orderBy('order')->get();
        return view('student.courses.index', compact('courses'));
    }

    public function show(string $slug): View
    {
        $course = \App\Models\Course::where('slug', $slug)
            ->where('published', true)
            ->with('modules.lessons')
            ->firstOrFail();

        return view('student.courses.show', compact('course'));
    }
}
