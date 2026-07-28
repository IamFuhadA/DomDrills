<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function show(string $slug): View
    {
        $lesson = Lesson::where('slug', $slug)->with(['video', 'module.course'])->firstOrFail();
        $course = $lesson->module->course;

        abort_unless($course->published, 404);

        // Load curriculum for sidebar navigation
        $modules = $course->modules()->with('lessons')->orderBy('order')->get();
        $videoUrl = $lesson->video?->video_path
            ? URL::temporarySignedRoute('student.lessons.video', now()->addHours(2), ['slug' => $lesson->slug])
            : null;

        return view('student.lessons.show', compact('lesson', 'course', 'modules', 'videoUrl'));
    }

    public function updateProgress(Request $request, string $slug): JsonResponse
    {
        $lesson = Lesson::where('slug', $slug)->with('module.course')->firstOrFail();

        abort_unless($lesson->module->course->published, 404);

        LessonProgress::updateOrCreate(
            [
                'user_id' => $request->user()->id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed_at' => now(),
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Progress updated.',
        ]);
    }

    public function streamVideo(string $slug)
    {
        $lesson = Lesson::where('slug', $slug)->with('video')->firstOrFail();
        abort_unless($lesson->module->course->published, 404);

        if ($lesson->video && $lesson->video->video_path) {
            $privateRoot = realpath(storage_path('app/private'));
            $path = realpath(storage_path('app/private/' . $lesson->video->video_path));

            if ($privateRoot && $path && str_starts_with($path, $privateRoot) && file_exists($path)) {
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

        abort(404);
    }
}
