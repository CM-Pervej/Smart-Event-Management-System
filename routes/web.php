<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication
Route::get('/register', function(){ return view('auth.register'); })->name('register');

Route::post('/register', [AuthController::class, 'registration'])->name('users.register');

Route::get('/login', function(){ return view('auth.login'); })->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('customers.login');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Profile
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');

Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');


// Organization
Route::get('/organizations/active', [OrganizationController::class, 'active'])->name('organizations.active');

Route::get('/organizations/inactive', [OrganizationController::class, 'inactive'])->name('organizations.inactive');

Route::get('/organization/create', [OrganizationController::class, 'create'])->name('organizations.create');

Route::post('/organizations/store', [OrganizationController::class, 'store'])->name('organizations.store');

Route::get('/organization/{slug}', [OrganizationController::class, 'showBySlug'])->name('organizations.organization');

Route::get('/organizations/edit/{slug}', [OrganizationController::class, 'edit'])->name('organizations.edit');

Route::put('/organizations/{slug}', [OrganizationController::class, 'update'])->name('organizations.update');


// Organizers
Route::get('/organizations/{organization:slug}/employees', [OrganizerController::class, 'show'])->name('organizers.organizers');

Route::get('/Organizations/{organization:slug}/employees/create', [OrganizerController::class, 'create'])->name('organizers.create');

Route::post('/Organizations/{organization:slug}/employees', [OrganizerController::class, 'store'])->name('organizers.store');


// Events Category
Route::get('/events', function(){ return view('events.index'); })->name('events.index');

Route::get('/events/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::post('/events/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::put('/events/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::delete('/events/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


// Events Sub-category
Route::get('/events/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');

Route::post('/events/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');

Route::put('/events/subcategories/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');

Route::delete('/events/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');