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
Route::controller(UserController::class)->group(function () {
    Route::name('login')->group(function () {
        Route::get('/', 'showLoginPage');
        Route::post('/', 'login');
    });

    Route::name('register')->group(function () {
        Route::get('/register', 'showRegisterPage');
        Route::post('/register', 'register');
    });
    
    Route::name('logout')->match(['get', 'post'], '/logout', 'logout');
});

/**
 * Link routes
 */
Route::middleware('auth:web')->group(function () {
    Route::prefix('links')->controller(LinkController::class)->group(function () {
        Route::name('links')->get('/', 'showLinksPage');

        Route::name('createLink')->group(function () {
            Route::get('/create', 'showCreateLinkPage');
            Route::post('/create', 'store');
        });

        Route::name('editLink')->group(function () {
            Route::get('/edit', 'showEditLinkPage');
            Route::put('/edit', 'update');
        });

        Route::name('deleteLink')->group(function () {
            Route::get('/delete', 'showDeleteLinkPage');
            Route::delete('/delete', 'delete');
        });
    });
});

Route::get('/{linkKey?}', [LinkController::class, 'redirectToUserLink']);
