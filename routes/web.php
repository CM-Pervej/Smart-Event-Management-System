<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
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

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');

Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/organization', [OrganizerController::class, 'show'])->name('organizer.organizer');

Route::get('/organization', [OrganizerController::class, 'create'])->name('organizer.create');