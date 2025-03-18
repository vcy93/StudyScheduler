<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudyScheduleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate-schedule', [StudyScheduleController::class, 'generateSchedule']);
