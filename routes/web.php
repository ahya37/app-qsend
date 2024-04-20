<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signin',[LoginController::class,'loginpage'])->name('loginpage');
Route::post('/signin/store',[LoginController::class,'login'])->name('loginstore');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/logoutstore',[LoginController::class,'logout'])->name('logoutstore'); 

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
