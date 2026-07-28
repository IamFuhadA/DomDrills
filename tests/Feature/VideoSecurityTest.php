<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\MembershipPlan;
use App\Models\Module;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

afterEach(function () {
    Storage::disk('local')->delete('courses/videos/secure-test.mp4');

    @rmdir(storage_path('app/private/courses/videos'));
    @rmdir(storage_path('app/private/courses'));
});

function createVideoMember(): User
{
    $user = User::factory()->create();
    $plan = MembershipPlan::create([
        'name' => 'Video Test Plan',
        'slug' => 'video-test-plan-' . $user->id,
        'price' => 1000,
        'billing_period' => 'monthly',
    ]);

    $user->memberships()->create([
        'membership_plan_id' => $plan->id,
        'status' => 'active',
        'expires_at' => now()->addMonth(),
    ]);

    return $user;
}

function createLessonVideo(): Lesson
{
    $course = Course::create([
        'title' => 'Secure Video Course',
        'slug' => 'secure-video-course',
        'description' => 'A course for media security tests.',
        'published' => true,
    ]);

    $module = Module::create([
        'course_id' => $course->id,
        'title' => 'Secure Module',
        'order' => 1,
    ]);

    $lesson = Lesson::create([
        'module_id' => $module->id,
        'title' => 'Secure Lesson',
        'slug' => 'secure-lesson',
        'order' => 1,
        'duration_minutes' => 5,
    ]);

    Video::create([
        'lesson_id' => $lesson->id,
        'provider' => 'local',
        'video_path' => 'courses/videos/secure-test.mp4',
    ]);

    return $lesson;
}

test('lesson video stream requires a valid signature', function () {
    $user = createVideoMember();
    $lesson = createLessonVideo();

    $this->actingAs($user)
        ->get(route('student.lessons.video', $lesson->slug))
        ->assertForbidden();
});

test('lesson page emits a signed private video url', function () {
    $user = createVideoMember();
    $lesson = createLessonVideo();

    $this->actingAs($user)
        ->get(route('student.lessons.show', $lesson->slug))
        ->assertOk()
        ->assertSee('signature=', false)
        ->assertDontSee('commondatastorage.googleapis.com', false);
});

test('signed lesson video stream only serves private files', function () {
    Storage::disk('local')->put('courses/videos/secure-test.mp4', 'fake-video');

    $user = createVideoMember();
    $lesson = createLessonVideo();
    $url = URL::temporarySignedRoute('student.lessons.video', now()->addMinutes(10), [
        'slug' => $lesson->slug,
    ]);

    $this->actingAs($user)
        ->get($url)
        ->assertOk()
        ->assertHeader('x-content-type-options', 'nosniff');
});
