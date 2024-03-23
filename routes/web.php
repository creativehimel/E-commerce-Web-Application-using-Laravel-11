<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// ================= Auth Route =================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'viewLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register','viewRegister')->name('register');
    Route::post('/register','register')->name('register.post');
    Route::get('/logout', 'logout')->name('logout');
});

// ================= Admin Route =================
// Route::prefix('admin')->group(function () {
//     Route::middleware('admin')->group(function () {
//         Route::controller(AdminDashboardController::class)->group(function () {
//                 Route::get('/dashboard', 'index')->name('admin.dashboard');
//                 Route::get('/profile', 'getAdminDetails')->name('admin.profile');
//                 Route::post('/profile/update', 'updateAdminProfile')->name('admin.profile.update');
//                 Route::post('/change-password', 'changePassword')->name('admin.password.update');
//         });
//         Route::resource('/cms-pages', CMSPageController::class);
//         Route::post('/cms-pages/change-status', [CMSPageController::class, 'status'])->name('cms-pages.change-status');
//         Route::get('/{slug}/edit', [CMSPageController::class, 'edit'])->name('cms-pages.edit');
//     });
// });