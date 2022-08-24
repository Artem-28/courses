<?php

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
