<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicSurveyController;

Route::get('/survey/{audience}', [PublicSurveyController::class, 'show'])
    ->name('survey.show');

Route::post('/survey/{audience}', [PublicSurveyController::class, 'submit'])
    ->name('survey.submit');

Route::get('/thanks', [PublicSurveyController::class, 'thanks'])
    ->name('survey.thanks');