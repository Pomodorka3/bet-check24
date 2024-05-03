<?php

use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('community', CommunityController::class);
    Route::get('community/{community}/join', [CommunityController::class, 'join'])
        ->name('community.join');
    Route::get('community/{community}/leave', [CommunityController::class, 'leave'])
        ->name('community.leave');

    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])
        ->name('admin-panel');
//    ->middleware(['auth', 'can:admin']);

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

});



//Route::view('profile', 'profile')
//    ->middleware(['auth'])
//    ->name('profile');

require __DIR__.'/auth.php';
