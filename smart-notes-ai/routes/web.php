<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\QuizController;
use App\Http\Middleware\CheckLogin;

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', [DashboardController::class, 'index'])->middleware(CheckLogin::class);
Route::get('/notes', [NoteController::class, 'index']);
Route::get('/quiz', [QuizController::class, 'index'])->middleware(CheckLogin::class);
Route::get('/show-quiz', [QuizController::class, 'show'])->middleware(CheckLogin::class);
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::post('/notes/summarize', [NoteController::class, 'summarize'])->name('notes.summarize');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');