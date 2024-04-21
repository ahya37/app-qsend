<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/signin',[LoginController::class,'loginpage'])->name('loginpage');
Route::post('/signin/store',[LoginController::class,'login'])->name('loginstore');

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::post('/logoutstore',[LoginController::class,'logout'])->name('logoutstore'); 

   Route::controller(WaController::class)->group(function(){
        Route::get('/qrcode/create', 'qrcode')->name('qrcode.create');
        Route::post('/qrcode/generate', 'generateQrCode')->name('qrcode.generate');

        Route::get('/message/create', 'textMessage')->name('message.create');
        Route::post('/message/store', 'textMessageStore')->name('message.store');
   });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
