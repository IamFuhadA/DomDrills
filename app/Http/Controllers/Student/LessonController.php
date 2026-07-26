<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\LessonProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LessonController extends Controller
{
    public function show(string $slug): View
    {
        $lesson = Lesson::where('slug', $slug)->with(['video', 'module.course'])->firstOrFail();
        $course = $lesson->module->course;

        // Load curriculum for sidebar navigation
        $modules = $course->modules()->with('lessons')->orderBy('order')->get();

        return view('student.lessons.show', compact('lesson', 'course', 'modules'));
    }

    public function updateProgress(Request $request, string $slug): JsonResponse
    {
        $lesson = Lesson::where('slug', $slug)->firstOrFail();

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

        if ($lesson->video && $lesson->video->video_path) {
            $path = storage_path('app/private/' . $lesson->video->video_path);
            if (file_exists($path)) {
                return response()->file($path, [
                    'Content-Type' => 'video/mp4',
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                ]);
            }
        }

        // Fallback video for testing
        return redirect()->away('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4');
    }
}
