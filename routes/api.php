<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PollController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::post('chat', [ChatController::class, 'store']);
Route::get('contests', [ContestController::class, 'getContests']);

Route::get('polls', [PollController::class, 'getPolls']);
Route::get('polls/{id}', [PollController::class, 'getAPoll']);
Route::get('polls/{id}/answers', [PollController::class, 'getAnswersFromAPoll']);

//Route::get('Answers/{id}', [PollController::class, 'getAnswersFromAPoll']);
