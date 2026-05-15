<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/list', [UserController::class, 'get'])->name('user.list')->middleware('can:manage-users');
    Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.detail')->middleware('can:edit-users');

    Route::post('/user/save', [UserController::class, 'store'])->name('user.store');
});

require __DIR__.'/auth.php';
