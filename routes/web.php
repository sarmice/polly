<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\VoteController;

// Home page - list all polls
Route::get('/', [PollController::class, 'index'])->name('polls.index');

// Show the form to create a new poll
Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');

// Store a new poll
Route::post('/polls', [PollController::class, 'store'])->name('polls.store');

// Show a specific poll by uuid
Route::get('/polls/{uuid}', [PollController::class, 'show'])->name('polls.show');

// Store a vote for a poll option
Route::post('/votes', [VoteController::class, 'store'])->name('votes.store');

// If you have other routes that require authentication, you can group them here
// Route::middleware(['auth'])->group(function () {
//     // ... routes that require authentication
// });

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
require __DIR__.'/auth.php';
