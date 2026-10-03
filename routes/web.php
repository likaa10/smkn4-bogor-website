<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jurusan/{major:slug}', [HomeController::class, 'showMajor'])->name('major.show');
Route::get('/galeri', [HomeController::class, 'gallery'])->name('gallery');
Route::post('/kontak', [HomeController::class, 'sendMessage'])->name('contact.send');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('user')->prefix('home')->name('user.')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('majors', MajorController::class)->except('show');
    Route::resource('informations', InformationController::class)->except('show');
    Route::resource('galleries', GalleryController::class)->except('show');

    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});