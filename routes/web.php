<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;


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

// Routeing Method
// get->view
// post->Store
// put->Store
// patch->Store/ Update
// delete->Delete

Route::get('/', function () {
    return view('login');
})->name('login');

// Auth::routes();

Route::post('user/login', [LoginController::class, 'login'])->name('user.login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('store');

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('relationships', [HomeController::class, 'relationships'])->name('relationships');



Route::prefix('contact/')->group(function () {
    Route::controller(ContactController::class)->group(function () {
        Route::get('list', 'index')->name('contact.list'); // Read
        Route::post('store', 'store')->name('contact.store'); // store
        Route::get('create', 'create')->name('contact.create'); // Create
        Route::post('update', 'update')->name('contact.update'); // update
        Route::get('delete/{id}', 'delete')->name('contact.delete'); // delete
        Route::get('edit/{id}', 'edit')->name('contact.edit'); // edit
        Route::get('show/{id}', 'show')->name('contact.show');

        
    });
});