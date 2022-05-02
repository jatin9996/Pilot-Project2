<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductListController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserListController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\ProductListController as UserProductListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//prefix('admin')
Route::name('admin.')->group(function () {
    Route::group(['middleware' => 'auth.check.admin.not'], function () {
        /** Login */
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/', [LoginController::class, 'login'])->name('login');

        Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [RegisterController::class, 'register'])->name('register');
    });

    Route::group(['middleware' => 'auth.check.admin'], function () {
        /** Logout Service */
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        Route::prefix('dashboard')->name('dashboard.')
            ->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('index');
            });

        Route::prefix('products')->name('products.')->group(function () {
            Route::post('fetch', [ProductListController::class, 'get'])->name('fetch');
        });
        Route::resource('products', ProductController::class);

        Route::group(['middleware' => 'auth.check.admin.user'], function () {
            /** User list Controller */
            Route::prefix('users')->name('users.')->group(function () {
                Route::post('fetch', [UserListController::class, 'get'])->name('fetch');
            });
            Route::resource('users', UserController::class);

            Route::prefix('user-products')->name('user-products.')->group(function () {
                Route::post('fetch', [UserProductListController::class, 'get'])->name('fetch');
                Route::post('list-user-products/{user_products}', [UserProductListController::class, 'get'])->name('list-user-products');
            });
            Route::resource('user-products', UserProductController::class)
                ->only(['index', 'show', 'destroy', 'update', 'edit']);
        });
    });
});
