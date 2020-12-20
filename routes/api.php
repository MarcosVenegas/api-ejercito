<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SoldadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\MisionController;
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

Route::prefix('soldados')->group(function () {

	Route::post('/create',[SoldadoController::class, 'createSoldado']);
	Route::post('/update/{numeroPlaca}',[SoldadoController::class, 'updateSoldado']);
	Route::post('/delete/{numeroPlaca}',[SoldadoController::class, 'deleteSoldado']);
	Route::get('/',[SoldadoController::class, 'listSoldados']);
	Route::get('/details/{numeroPlaca}',[SoldadoController::class, 'viewSoldado']);
	Route::post('/addEquipo',[SoldadoController::class, 'addEquipo']);
});

Route::prefix('equipos-tacticos')->group(function () {

	Route::post('/create',[EquipoController::class, 'createEquipo']);
	Route::post('/update/{id}',[EquipoController::class, 'updateEquipo']);
	Route::post('/delete/{id}',[EquipoController::class, 'deleteEquipo']);
	Route::get('/',[EquipoController::class, 'listEquipos']);
	Route::get('/details/{id}',[EquipoController::class, 'viewEquipo']);
});

Route::prefix('misions')->group(function () {

	Route::post('/create',[MisionController::class, 'createMision']);
	Route::post('/update/{id}',[MisionController::class, 'updateMision']);
	Route::post('/delete/{id}',[MisionController::class, 'deleteMision']);
	Route::get('/',[MisionController::class, 'listMisiones']);
	Route::get('/details/{id}',[MisionController::class, 'viewMision']);
});