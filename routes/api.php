<?php

use App\Http\Controllers\API\RoleController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'as' => 'v1.', 'middleware' => ['jsonResponse']], function () {
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('create', [RoleController::class, 'store'])->name('create');
        Route::put('{rolesId}', [RoleController::class, 'edit'])->name('edit');
        Route::delete('{rolesId}', [RoleController::class, 'destroy'])
            ->name('delete');
        Route::get('{rolesId}', [RoleController::class, 'show'])->name('show');
    });
});