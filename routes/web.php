<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCafeController;
use App\Http\Controllers\Admin\AdminReviewController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [CafeController::class, 'index'])->name('cafes.index');
Route::get('/cafes/{cafe}', [CafeController::class, 'show'])->name('cafes.show');

Route::middleware('auth')->group(function () {
    Route::post('/cafes/{cafe}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('cafes', AdminCafeController::class);
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::patch('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject', [AdminReviewController::class, 'reject'])->name('reviews.reject');
    Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
});
