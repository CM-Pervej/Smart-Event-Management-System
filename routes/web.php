<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function(){
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'registration'])->name('users.register');

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('customers.login');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
