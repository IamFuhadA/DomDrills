<?php

use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\LessonController;
use App\Http\Controllers\Student\SessionController;
use App\Http\Controllers\Student\ToolController;
use App\Http\Controllers\Student\SupportController;
use App\Http\Controllers\Student\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Student Portal Routes
| Requires: auth, verified email, active membership
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'membership'])
     ->prefix('dashboard')
     ->name('student.')
     ->group(function () {

    Route::get('/',                     [DashboardController::class, 'index'])->name('dashboard');

    // Courses
    Route::get('/courses',              [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{slug}',       [CourseController::class, 'show'])->name('courses.show');

    // Lessons
    Route::get('/lessons/{slug}',       [LessonController::class, 'show'])->name('lessons.show');
    Route::get('/lessons/{slug}/video', [LessonController::class, 'streamVideo'])->name('lessons.video');
    Route::post('/lessons/{slug}/progress', [LessonController::class, 'updateProgress'])->name('lessons.progress');

    // Live Sessions
    Route::get('/sessions',             [SessionController::class, 'index'])->name('sessions.index');
    Route::get('/sessions/{id}',        [SessionController::class, 'show'])->name('sessions.show');

    // Trading Tools
    Route::get('/tools',                [ToolController::class, 'index'])->name('tools.index');
    Route::get('/tools/{slug}',         [ToolController::class, 'show'])->name('tools.show');

    // Profile
    Route::get('/profile',              [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile',            [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password',     [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile',           [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Support
    Route::get('/support',              [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/{id}',         [SupportController::class, 'show'])->name('support.show');
    Route::post('/support',             [SupportController::class, 'store'])->name('support.store');
    Route::post('/support/{id}/reply',  [SupportController::class, 'reply'])->name('support.reply');

});
