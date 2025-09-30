<?php

declare(strict_types=1);

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
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
