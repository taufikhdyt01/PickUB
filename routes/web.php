<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Conversation\ConversationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConversationController::class, 'index'])->middleware('auth');
Route::get('/new', [ConversationController::class, 'newConversations'])->middleware('auth');

Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/conversations', [ConversationController::class, 'createConversation'])->middleware('auth');
Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'sendMessage'])->middleware('auth');
Route::post('/conversations/{conversation}/typing', [ConversationController::class, 'sendStatusTyping'])->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/broadcasting/auth', function () {
    return Auth::check()
        ? response()->json(['authenticated' => true])
        : response()->json(['authenticated' => false], 403);
});
