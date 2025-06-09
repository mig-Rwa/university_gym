<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentCardController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/student-card/status', [StudentCardController::class, 'status']);
});
