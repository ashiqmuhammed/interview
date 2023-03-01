<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'homePage'])->name('main.home');

Auth::routes();

Route::group(['prefix' => 'users', 'middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('users.home');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::post('/get-users-table', [App\Http\Controllers\AdminController::class, 'getUsers'])->name('admin.getUsersTable');
});