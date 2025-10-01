<?php

declare(strict_types=1);

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('c')->group(function (): void {
    Route::get('/', [CommunityController::class, 'index'])->name('community.all');
    Route::get('/{community:subforum}', [CommunityController::class, 'show'])->name('community.show');

    Route::post('/{community:subforum}/join', [CommunityController::class, 'join'])
        ->middleware(['auth'])
        ->name('community.join');

    Route::delete('/{community:subforum}/leave', [CommunityController::class, 'leave'])
        ->middleware(['auth'])
        ->name('community.leave');
});

Route::prefix('p')->group(function (): void {
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('post.show');

    Route::post('/downvote/{post:slug}', [PostController::class, 'downvote'])
        ->middleware(['auth'])
        ->name('post.downvote');

    Route::post('/upvote/{post:slug}', [PostController::class, 'upvote'])
        ->middleware(['auth'])
        ->name('post.upvote');

});

// Comment routes
Route::prefix('comments')->middleware(['auth'])->group(function (): void {
    Route::post('/store/{post:slug}', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/reply/{comment}', [CommentController::class, 'reply'])->name('comment.reply');
    Route::post('/upvote/{comment}', [CommentController::class, 'upvote'])->name('comment.upvote');
    Route::post('/downvote/{comment}', [CommentController::class, 'downvote'])->name('comment.downvote');
});
