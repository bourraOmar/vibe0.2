<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendRequestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/posts', [PostController::class, 'posts'])
->middleware('auth')->name('posts');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');

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


Route::middleware(['auth'])->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/profile/{id}', [PostController::class, 'userPosts'])->name('profile');
});


Route::post('/posts/{post}/like', [LikeController::class, 'likePost'])->middleware('auth');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware('auth');


// Route::middleware('auth')->group(function () {
// });
    // routes/web.php
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
