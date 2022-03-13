<?php

use App\Http\Controllers\Dashboard\RecipesController;
use App\Http\Controllers\Dashboard\ServicesController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware('auth')
->prefix('dashboard')
->as('dashboard.')
->group(function () {

    Route::prefix('recipes')->as('recipes.')->group(function () {
        Route::get('/', [RecipesController::class, 'index'])->name('index');
    });

    Route::prefix('services')->as('services.')->group(function () {
        Route::get('/unavailable', [ServicesController::class, 'unavailable'])->name('unavailable');
    });

});
