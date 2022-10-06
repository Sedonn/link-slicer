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
    Route::name('logout')->post('/logout', 'logout');
});

/**
 * Link routes
 */
Route::middleware('auth:web')->controller(LinkController::class)->group(function () {
    Route::name('createLink')->group(function () {
        Route::get('/createlink', 'showCreateLinkPage');
        Route::post('/createlink', 'createUserLink');
    });

    Route::name('editLink')->group(function () {
        Route::get('/editlink', 'showEditLinkPage');
        Route::post('/editlink', 'editUserLink');
    });

    Route::name('deleteLink')->group(function () {
        Route::get('/deletelink', 'showDeleteLinkPage');
        Route::post('/deletelink', 'deleteUserLink');
    });

    Route::name('links')->group(function () {
        Route::get('/links', 'showLinksPage');
    });
});

Route::get('/{linkKey?}', [LinkController::class, 'redirectToUserLink']);
