<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/c/{subforum}', [HomeController::class, 'showCommunity'])->name('community.show');
Route::get('/communities', [HomeController::class, 'showAllCommunities'])->name('community.all');
