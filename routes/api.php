<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PollController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

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
Route::get('contests/{id}', [ContestController::class, 'getAContest']);
Route::post('contests/{id}', [ContestController::class, 'answerContest']);



Route::get('polls', [PollController::class, 'getPolls']);
Route::post('polls/disable', [PollController::class, 'disablePolls']);
Route::get('polls/{id}', [PollController::class, 'getAPoll']);
Route::post('polls/{id}/inactive', [PollController::class, 'setAPollInactive']);
Route::get('polls/{id}/answers', [PollController::class, 'getAnswersFromAPoll']);
Route::get('polls/{id}/answers/same', [PollController::class, 'getSameAnswersFromAPoll']);
Route::post('polls/{id}/answers', [PollController::class, 'sendAnswerToAPoll']);

Route::get('event/active', [EventController::class, 'getLatestActiveEvent']);
//Route::get('Answers/{id}', [PollController::class, 'getAnswersFromAPoll']);

//Route::get('answers/{id}/same', [AnswerController::class, 'getSameAnswersFromAPoll']);