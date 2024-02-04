<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\UserController;

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

/**
 * User routes
 */
Route::name('user.')->controller(UserController::class)->group(function () {
    Route::name('login.')->group(function () {
        Route::view('/', 'pages.login')->name('view');
        Route::name('action')->post('/', 'login');
    });

    Route::name('register.')->group(function () {
        Route::view('/register', 'pages.register')->name('view');
        Route::name('action')->post('/register', 'register');
    });

    Route::name('logout')->match(['get', 'post'], '/logout', 'logout');
});

Route::name('toSlicedLink')->get('/to/{linkKey?}', [LinkController::class, 'redirectToUserLink']);

/**
 * Link routes
 */
Route::middleware('auth:web')->group(function () {
    Route::name('links.')->prefix('links')->controller(LinkController::class)->group(function () {
        Route::name('view')->get('/', 'showLinksPage');

        Route::name('create.')->group(function () {
            Route::view('/create', 'pages.link_create')->name('view');
            Route::name('action')->post('/create', 'store');
        });

        Route::name('edit.')->group(function () {
            Route::name('view')->get('/edit', 'showEditLinkPage');
            Route::name('action')->put('/edit', 'update');
        });

        Route::name('delete.')->group(function () {
            Route::name('view')->get('/delete', 'showDeleteLinkPage');
            Route::name('action')->delete('/delete', 'delete');
        });
    });
});
