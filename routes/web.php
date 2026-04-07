<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\F1Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');

// Blog routes
Route::resource('posts', PostController::class);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// F1 Stats Hub Routes
Route::prefix('f1')->name('f1.')->group(function () {
    Route::get('/', [F1Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/drivers', [F1Controller::class, 'drivers'])->name('drivers');
    Route::get('/teams', [F1Controller::class, 'teams'])->name('teams');
    Route::get('/circuits', [F1Controller::class, 'circuits'])->name('circuits');
    Route::get('/seasons', [F1Controller::class, 'seasons'])->name('seasons');
});
