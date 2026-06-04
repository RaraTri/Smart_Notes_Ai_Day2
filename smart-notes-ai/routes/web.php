<?php

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
Route::get('/notes', [NoteController::class, 'index'])->middleware(CheckLogin::class);
Route::get('/quiz', [QuizController::class, 'index'])->middleware(CheckLogin::class);
Route::get('/show-quiz', [QuizController::class, 'show'])->middleware(CheckLogin::class);
