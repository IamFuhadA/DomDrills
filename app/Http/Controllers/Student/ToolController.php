<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ToolController extends Controller
{
    public function index(): View
    {
        return view('student.tools.index');
    }

    public function show(string $slug): View
    {
        return view('student.tools.show', ['slug' => $slug]);
    }
}
