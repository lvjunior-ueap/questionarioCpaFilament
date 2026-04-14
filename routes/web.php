<?php

use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicSurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('landing'))->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/survey/{audience}', [PublicSurveyController::class, 'show'])
        ->middleware('survey.audience')
        ->name('survey.show');

    Route::post('/survey/{audience}', [PublicSurveyController::class, 'submit'])
        ->middleware('survey.audience')
        ->name('survey.submit');

    Route::get('/thanks', [PublicSurveyController::class, 'thanks'])
        ->name('survey.thanks');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
    Route::get('/admin/reports/{survey}/pdf', [AdminReportController::class, 'pdf'])->name('admin.reports.pdf');
});
