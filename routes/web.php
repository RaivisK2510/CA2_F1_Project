<?php

use App\Http\Controllers\AdminController;
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
    return redirect()->route('f1.dashboard');
})->name('home');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    
    // F1 Data Management Routes
    Route::prefix('f1')->name('admin.f1.')->group(function () {
        Route::get('/', [AdminController::class, 'f1Dashboard'])->name('dashboard');
        
        // Drivers CRUD
        Route::get('/drivers', [AdminController::class, 'driversIndex'])->name('drivers.index');
        Route::get('/drivers/create', [AdminController::class, 'driversCreate'])->name('drivers.create');
        Route::post('/drivers', [AdminController::class, 'driversStore'])->name('drivers.store');
        Route::get('/drivers/{driver}/edit', [AdminController::class, 'driversEdit'])->name('drivers.edit');
        Route::put('/drivers/{driver}', [AdminController::class, 'driversUpdate'])->name('drivers.update');
        Route::delete('/drivers/{driver}', [AdminController::class, 'driversDestroy'])->name('drivers.destroy');
        
        // Teams CRUD
        Route::get('/teams', [AdminController::class, 'teamsIndex'])->name('teams.index');
        Route::get('/teams/create', [AdminController::class, 'teamsCreate'])->name('teams.create');
        Route::post('/teams', [AdminController::class, 'teamsStore'])->name('teams.store');
        Route::get('/teams/{team}/edit', [AdminController::class, 'teamsEdit'])->name('teams.edit');
        Route::put('/teams/{team}', [AdminController::class, 'teamsUpdate'])->name('teams.update');
        Route::delete('/teams/{team}', [AdminController::class, 'teamsDestroy'])->name('teams.destroy');
        
        // Circuits CRUD
        Route::get('/circuits', [AdminController::class, 'circuitsIndex'])->name('circuits.index');
        Route::get('/circuits/create', [AdminController::class, 'circuitsCreate'])->name('circuits.create');
        Route::post('/circuits', [AdminController::class, 'circuitsStore'])->name('circuits.store');
        Route::get('/circuits/{circuit}/edit', [AdminController::class, 'circuitsEdit'])->name('circuits.edit');
        Route::put('/circuits/{circuit}', [AdminController::class, 'circuitsUpdate'])->name('circuits.update');
        Route::delete('/circuits/{circuit}', [AdminController::class, 'circuitsDestroy'])->name('circuits.destroy');
        
        // Seasons CRUD
        Route::get('/seasons', [AdminController::class, 'seasonsIndex'])->name('seasons.index');
        Route::get('/seasons/create', [AdminController::class, 'seasonsCreate'])->name('seasons.create');
        Route::post('/seasons', [AdminController::class, 'seasonsStore'])->name('seasons.store');
        Route::get('/seasons/{season}/edit', [AdminController::class, 'seasonsEdit'])->name('seasons.edit');
        Route::put('/seasons/{season}', [AdminController::class, 'seasonsUpdate'])->name('seasons.update');
        Route::delete('/seasons/{season}', [AdminController::class, 'seasonsDestroy'])->name('seasons.destroy');
    });
});

// F1 Stats Hub Routes
Route::prefix('f1')->name('f1.')->group(function () {
    Route::get('/', [F1Controller::class, 'dashboard'])->name('dashboard');
    Route::get('/drivers', [F1Controller::class, 'drivers'])->name('drivers');
    Route::get('/teams', [F1Controller::class, 'teams'])->name('teams');
    Route::get('/circuits', [F1Controller::class, 'circuits'])->name('circuits');
    Route::get('/seasons', [F1Controller::class, 'seasons'])->name('seasons');
});
