<?php

use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['web'])->group(function () {

    // Language Switcher
    Route::get('/lang/{locale}', [LanguageController::class, 'switch'])
         ->name('lang.switch')
         ->where('locale', 'en|ml');

    // Public Pages
    Route::get('/',           [HomeController::class, 'index'])->name('home');
    Route::get('/services',   [HomeController::class, 'services'])->name('services');
    Route::get('/membership', [HomeController::class, 'membership'])->name('membership');
    Route::get('/about',      [HomeController::class, 'about'])->name('about');
    Route::get('/contact',    [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact',   [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/privacy',    [HomeController::class, 'privacy'])->name('privacy');
    Route::get('/terms',      [HomeController::class, 'terms'])->name('terms');
    Route::get('/risk-disclosure', [HomeController::class, 'riskDisclosure'])->name('risk-disclosure');

});

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/student.php';

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/admin.php';
