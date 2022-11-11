<?php

use App\Http\Controllers\api\AlunosApiController;
use App\Http\Controllers\api\CursosApiController;
use App\Http\Controllers\api\ImovelApiController;
use App\Http\Controllers\api\TurmasApiController;
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

Route::get('alunos', array(AlunosApiController::class, 'index'));

Route::get('cursos', array(CursosApiController::class, 'index'));
Route::post('cursos', array(CursosApiController::class, 'store'));


Route::get('turmas', array(TurmasApiController::class, 'index'));
Route::post('turmas', array(TurmasApiController::class, 'store'));

