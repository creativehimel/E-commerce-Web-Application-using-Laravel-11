<?php

use App\Http\Controllers\BackEnd\ManageUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BackEnd\CMSPageController;
use App\Http\Controllers\BackEnd\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// ================= Auth Route =================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'viewLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register','viewRegister')->name('register');
    Route::post('/register','register')->name('register.post');
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
    Route::controller(ManageUserController::class)->group(function () {
        Route::get('/sub-admins', 'getSubAdmin')->name('sub-admins.index');
        Route::get('/sub-admins/create', 'createSubAdmin')->name('sub-admins.create');
        Route::get('/users', 'getUser')->name('users.index'); 
    });
});