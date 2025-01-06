<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SearchController::class, 'search'])->name('index');
Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/car/{id}', [CarController::class, 'show'])->middleware('auth')->name('cars.show');

Route::post('/wishlist/store', [WishlistController::class, 'store'])->middleware('auth')->name('wishlist.store');
Route::post('/wishlist/destroy/{id}', [WishlistController::class, 'destroy'])->middleware('auth')->name('wishlist.destroy');

Route::get('/login',[SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login',[SessionsController::class, 'store'])->middleware('guest')->name('login.handler');
Route::post('/logout',[SessionsController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/cars/store', [CarController::class, 'store'])->middleware('auth')->name('cars.store');

Route::get('/register',[AuthController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register',[AuthController::class, 'store'])->middleware('guest')->name('register.handler');

Route::get('/user/cars/{id}', [CarController::class, 'cars'])->middleware('auth')->name('user.cars');

Route::get('/userProfile',[UserController::class, 'index'])->middleware('can:user')->name('userProfile');


Route::middleware('can:admin')->group(function () {
    Route::controller(AdminController::class)->group(function() {

        Route::get('/adminProfile', 'index')->name('adminProfile');

        Route::post('/admin/brand/store', 'brandStore')->name('admin.brand.store');
        Route::post('/admin/fuelType/store', 'FuelTypeStore')->name('admin.fuelType.store');
        Route::post('/admin/gearbox/store', 'GearboxStore')->name('admin.gearbox.store');
        Route::post('/admin/bodyType/store', 'BodyTypeStore')->name('admin.bodyType.store');
        Route::post('/admin/model/store', 'ModelStore')->name('admin.model.store');

        Route::post('/admin/brand/delete/{id}', 'brandDestroy')->name('admin.brand.delete');
        Route::post('/admin/fuelType/delete/{id}', 'FuelTypeDestroy')->name('admin.fuelType.delete');
        Route::post('/admin/gearbox/delete/{id}', 'GearboxDestroy')->name('admin.gearbox.delete');
        Route::post('/admin/bodyType/delete/{id}', 'BodyTypeDestroy')->name('admin.bodyType.delete');
        Route::post('/admin/model/delete/{id}', 'ModelDestroy')->name('admin.model.delete');

    });
});



Route::get('/get-models', [SearchController::class, 'getModels'])->name('get.models');
