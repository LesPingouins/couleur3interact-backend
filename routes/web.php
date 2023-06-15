<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create']);

//Chat 
Route::get('/chat', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('chat');

//Roles
Route::get('/roles', [RoleController::class, 'index'])->middleware(['auth', 'verified'])->name('roles');

//Users
Route::middleware('auth')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
    Route::get('/users/form/add', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store');
    Route::get('/users/form/edit/{id}', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users.delete');
    Route::post('/users/active/{id}', [UserController::class, 'active'])->middleware(['auth', 'verified'])->name('users.active');
});

//Settings
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingController::class, 'index'])->middleware(['auth', 'verified'])->name('settings.index');
    Route::get('/settings/create', [SettingController::class, 'create'])->middleware(['auth', 'verified'])->name('settings.create');
});

//Polls
Route::middleware('auth')->group(function () {
    Route::get('/polls', [PollController::class, 'index'])->middleware(['auth', 'verified'])->name('polls.index');
    Route::get('/polls/create', [PollController::class, 'create'])->middleware(['auth', 'verified'])->name('polls.create');
    Route::get('/polls/edit', [PollController::class, 'edit'])->middleware(['auth', 'verified'])->name('polls.edit');
    Route::post('/polls/store', [PollController::class, 'store'])->middleware(['auth', 'verified'])->name('polls.store');
});

//Contests
Route::middleware('auth')->group(function () {
    Route::get('/contests', [ContestController::class, 'index'])->middleware(['auth', 'verified'])->name('contests.index');
    Route::get('/contests/create', [ContestController::class, 'create'])->middleware(['auth', 'verified'])->name('contests.create');
    Route::get('/contests/edit', [ContestController::class, 'edit'])->middleware(['auth', 'verified'])->name('contests.edit');
    Route::post('/contests/store', [ContestController::class, 'store'])->middleware(['auth', 'verified'])->name('contests.store');
});

//Logout
Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth', 'verified'])->name('logout');

require __DIR__ . '/auth.php';
