<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/registration', [\App\Http\Controllers\Api\AuthController::class, 'registration']);
Route::post('auth/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('sendCode', [\App\Http\Controllers\Api\SendCodeController::class, 'sendCode']);

Route::post('teacher/add-to-account', [\App\Http\Controllers\Api\TeacherController::class, 'addToAccount']);
Route::patch('teacher/accept-invite', [\App\Http\Controllers\Api\TeacherController::class, 'acceptInvite']);
Route::delete('teacher/remove-from-account', [\App\Http\Controllers\Api\TeacherController::class, 'removeFromAccount']);

Route::resource('attachment', \App\Http\Controllers\Api\AttachmentController::class);

//категории
Route::get('/get-categories', [CategoryController::class, 'index']);

//курсы
Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'edit']);
Route::post('/courses/{id}', [CourseController::class, 'update']);

//уроки
Route::get('/lessons', [LessonController::class, 'index']);
Route::post('/lessons', [LessonController::class, 'store']);
Route::get('/lessons/{id}', [LessonController::class, 'edit']);
Route::post('/lessons/{id}', [LessonController::class, 'update']);
