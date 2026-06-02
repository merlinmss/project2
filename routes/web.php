<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\S3UploadController;

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

    // Check permissions using Gate and Can method by AppServiceProvider
    Route::get('/user/list', [UserController::class, 'get'])->name('user.list')->middleware('can:manage-users');
    Route::post('/user/save', [UserController::class, 'store'])->name('user.store')->middleware('can:edit-users');

    // Check role access using middleware
    Route::middleware('roles:super_admin,admin')->group(function () {
        Route::get('/user/detail/{id}', [UserController::class, 'show'])->name('user.detail');
        Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });

    
});

Route::get('s3-upload', [S3UploadController::class, 'uploadForm']);
Route::post('s3-upload', [S3UploadController::class, 'uploadFile'])->name('s3.upload');

require __DIR__.'/auth.php';
