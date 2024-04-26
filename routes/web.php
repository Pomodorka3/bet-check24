<?php

use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::resource('community', CommunityController::class);

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])
    ->name('admin-panel');
//    ->middleware(['auth', 'can:admin']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Route::view('profile', 'profile')
//    ->middleware(['auth'])
//    ->name('profile');

require __DIR__.'/auth.php';
