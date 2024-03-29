<?php

use App\Http\Controllers\Api\IngredientsController;
use App\Http\Controllers\Api\PurchasesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('internal.communication')->group(function () {

    Route::prefix('ingredients')->group(function () {
        Route::get('/', [IngredientsController:: class, 'index']);
    });

    Route::prefix('purchases')->group(function () {
        Route::get('/{ingredient}', [PurchasesController::class, 'index']);
    });

});

