<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AvatarController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\LectureController;
use App\Http\Controllers\Api\V1\RecordController;
use App\Http\Controllers\Api\V1\TokenController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sanctum/token', TokenController::class);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show'])->where('course', '[0-9]+');
Route::post('/courses/{course}/picture', [CourseController::class, 'picture'])->where('course', '[0-9]+');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/auth', AuthController::class);
    Route::post('/users/auth/avatar', [AvatarController::class, 'store'])->middleware(['verified']);

    Route::put('/users/{user}/admin', [UserController::class, 'admin']);
    Route::get('/user/records', [RecordController::class, 'index']);
    Route::post('/user/records', [RecordController::class, 'store']);
    Route::get('/user/records/has-record', [RecordController::class, 'hasRecord']);

    Route::middleware(['admin'])->group(function () {
        Route::post('/courses', [CourseController::class, 'store']);
        Route::put('/courses/{course}', [CourseController::class, 'update'])->where('course', '[0-9]+');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->where('lecture', '[0-9]+');

        Route::post('/lectures', [LectureController::class, 'store']);
        Route::delete('/lectures/{lecture}', [LectureController::class, 'destroy'])->where('lecture', '[0-9]+');
        Route::get('/lectures/{lecture}/users', [LectureController::class, 'users'])->where('lecture', '[0-9]+');
    });
});
