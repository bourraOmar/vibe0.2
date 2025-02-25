<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendRequestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profileUser/{id}', [UserController::class, 'show'])->name('profileUser');

Route::get('/users', [UserController::class, 'getAllUsers'])
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::get('/search', [UserController::class, 'search']);

require __DIR__ . '/auth.php';

// email sender
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//friends requists

Route::middleware(['auth'])->group(function () {
    Route::post('/friend-request/{id}', [FriendRequestController::class, 'sendRequest'])->name('request.send');
    Route::post('/friend-request/accept/{id}', [FriendRequestController::class, 'acceptRequest'])->name('friend.request.accept');
    Route::post('/friend-request/reject/{id}', [FriendRequestController::class, 'rejectRequest'])->name('friend.request.reject');
});

Route::get('/friend-requests', [FriendRequestController::class, 'showRequests'])->name('requests');


//list friends

Route::get('/friends', [UserController::class, 'friendsList'])->name('friends')->middleware('auth');


