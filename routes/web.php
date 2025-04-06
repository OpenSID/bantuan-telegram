<?php

use App\Http\Controllers\FAQController;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::resource('faqs', FAQController::class);
    });
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

