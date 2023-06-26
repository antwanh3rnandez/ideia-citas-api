<?php

use App\Http\Controllers\Api\V1\CitasController;
use App\Http\Controllers\Api\V1\CompleteTaskController;
use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::patch('/tasks/{task}/complete', CompleteTaskController::class);
    Route::apiResource('/citas', CitasController::class);

    Route::get('/getCitas', [CitasController::class, 'show'])
        ->name('v1.getCitas');

    Route::post('/citas/{type}/{id}/1', [CitasController::class, 'update'])
        ->name('v1.updateStatusCitas');

    Route::get('/citas/comment/{id}', [CitasController::class, 'getMessageById'])
        ->name('v1.getCommentById');

    Route::post('/citas/send-comment/{id}/{comment}', [CitasController::class, 'updateMessageById'])
        ->name('v1.updateMessageById');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
