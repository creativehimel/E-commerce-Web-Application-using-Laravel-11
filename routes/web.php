<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BackEnd\CMSPageController;
use App\Http\Controllers\BackEnd\DashboardController;
use App\Http\Controllers\BackEnd\ManageSubAdminController;
use App\Http\Controllers\BackEnd\ManageUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// ================= Auth Route =================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'viewLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'viewRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// ================= Admin Route =================
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('admin.dashboard');
        Route::get('/profile', 'getAdminDetails')->name('admin.profile');
        Route::post('/profile/update', 'updateAdminProfile')->name('admin.profile.update');
    });
    Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('admin.password.update');

    //Manage Cms Page Routes
    Route::resource('/cms-pages', CMSPageController::class);
    Route::post('/cms-pages/change-status', [CMSPageController::class, 'changeStatus'])->name('cms-pages.change-status');

    //Manage Sub Admin Routes
    Route::resource('/sub-admins', ManageSubAdminController::class);
    Route::post('/sub-admins/change-status', [ManageSubAdminController::class, 'changeStatus'])->name('sub-admins.change-status');
    //Manage Customer Routes
    Route::resource('/manage-customers', ManageUserController::class);
});
