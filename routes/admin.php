<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ActivityLogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
| Requires: auth, verified email, admin role
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::patch('/users/{user}/suspend',  [UserController::class, 'suspend'])->name('users.suspend');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::patch('/users/{user}/toggle-membership', [UserController::class, 'toggleMembership'])->name('users.toggle-membership');
    Route::post('/users/{user}/send-credentials', [UserController::class, 'sendCredentials'])->name('users.send-credentials');

    // Courses
    Route::resource('courses', CourseController::class);

    // Modules
    Route::resource('courses.modules', ModuleController::class)->shallow();

    // Lessons
    Route::resource('modules.lessons', LessonController::class)->shallow();

    // Videos
    Route::resource('lessons.videos', VideoController::class)->shallow();
    Route::get('/videos/{video}/stream', [VideoController::class, 'stream'])->name('videos.stream');

    // Live Sessions
    Route::resource('sessions', SessionController::class);

    // Trading Tools
    Route::resource('tools', ToolController::class);

    // Memberships
    Route::resource('memberships', MembershipController::class);

    // Support Tickets
    Route::get('/support',              [SupportController::class, 'index'])->name('support.index');
    Route::get('/support/{ticket}',     [SupportController::class, 'show'])->name('support.show');
    Route::post('/support/{ticket}/reply', [SupportController::class, 'reply'])->name('support.reply');
    Route::patch('/support/{ticket}/close', [SupportController::class, 'close'])->name('support.close');

    // Settings
    Route::get('/settings',             [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings',            [SettingsController::class, 'update'])->name('settings.update');

    // Activity Logs
    Route::get('/logs',                 [ActivityLogController::class, 'index'])->name('logs.index');
});
