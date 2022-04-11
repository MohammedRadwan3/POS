<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    ['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
            Route::get('/index', [DashboardController::class, 'index'])->name('home');

            // user routes
            Route::resource('users', 'UserController')->except(['show']);

            //category routes
            Route::resource('categories', 'CategoryController')->except(['show']);

            //product routes
            Route::resource('products', 'ProductController')->except(['show']);
        });

    }
);
