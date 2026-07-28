<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LiveSession;
use Illuminate\Support\Facades\URL;
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
        $recordingUrl = $session->recording_path
            ? URL::temporarySignedRoute('student.sessions.recording', now()->addHours(2), ['id' => $session->id])
            : null;

        return view('student.sessions.show', compact('session', 'recordingUrl'));
    }

    public function streamRecording(int $id)
    {
        $session = LiveSession::findOrFail($id);

        if (! $session->recording_path) {
            abort(404);
        }

        $privateRoot = realpath(storage_path('app/private'));
        $path = realpath(storage_path('app/private/' . $session->recording_path));

        if (! $privateRoot || ! $path || ! str_starts_with($path, $privateRoot) || ! file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'video/mp4',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Content-Disposition' => 'inline',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'DENY',
            'Referrer-Policy' => 'same-origin',
        ]);
    }
}
