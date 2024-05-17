<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FootballMatchController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::resource('community', CommunityController::class);
    Route::get('community/{community}/join', [CommunityController::class, 'join'])
        ->name('community.join');
    Route::get('community/{community}/leave', [CommunityController::class, 'leave'])
        ->name('community.leave');

    Route::resource('football-match', FootballMatchController::class);

    Route::get('dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');
    Route::get('/', [DashboardController::class, 'index']);
});

Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');
});



//Route::view('profile', 'profile')
//    ->middleware(['auth'])
//    ->name('profile');

require __DIR__.'/auth.php';
