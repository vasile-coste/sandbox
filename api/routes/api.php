<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\SolutionController;
use App\Http\Controllers\TaskController;
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

// solution
Route::group(['prefix' => 's'], function () {
    Route::post('save', [SolutionController::class, 'apiSave'])->name('solution.save');
    Route::get('all/{task_id}', [SolutionController::class, 'apiGetSolutions'])->name('solution.getAll');
    Route::post('run', [SolutionController::class, 'apiRun'])->name('solution.run');
});

// task
Route::group(['prefix' => 't'], function () {
    Route::post('list', [TaskController::class, 'apiGetTasks'])->name('task.list');
});

