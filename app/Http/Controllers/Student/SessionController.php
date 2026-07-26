<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LiveSession;
use Illuminate\View\View;

class SessionController extends Controller
{
    public function index(): View
    {
        $sessions = LiveSession::orderBy('scheduled_at', 'desc')->get();
        return view('student.sessions.index', compact('sessions'));
    }

    public function show(int $id): View
    {
        $session = LiveSession::findOrFail($id);
        return view('student.sessions.show', compact('session'));
    }
}
