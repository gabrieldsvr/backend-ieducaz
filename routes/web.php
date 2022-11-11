<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\FunnelCardsController;
use App\Http\Controllers\FunnelsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\WebController;
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

Route::middleware(['auth', 'auth.session'])->group(callback: function () {
    Route::get('/', [WebController::class, 'dashboard'])->name('dashboard');

    Route::resource('people', PeopleController::class)->only(['index', 'store', 'destroy', 'update']);
    Route::resource('funnel', FunnelsController::class)->only(['index', 'store', 'destroy', 'update']);
    Route::resource('funnelCard', FunnelCardsController::class)->only(['index', 'store', 'destroy', 'update']);
});

Route::resource('people', PeopleController::class)->only(['create', 'edit']);
Route::resource('funnel', FunnelsController::class)->only(['create', 'edit']);
Route::resource('funnelCard', FunnelCardsController::class)->only(['create', 'edit']);


Route::post('/funnelCard/changePosition', [FunnelCardsController::class, 'changePosition'])->name('funnelCard.change-position');
Route::post('/funnelCard/getCard', [FunnelCardsController::class, 'getCard'])->name('funnelCard.getCard');


Route::get('/people/all', [PeopleController::class, 'all'])->name('people.all');
Route::get('/people/create-modal', [PeopleController::class, 'createModal'])->name('people.modal');


Route::get('/website/{id}', [WebController::class, 'website'])->name('website');
Route::get('/imovel/upload-file', [FileUploadController::class, 'createForm']);
Route::post('/imovel/upload-file', [FileUploadController::class, 'fileUpload'])->name('fileUpload');

require __DIR__ . '/auth.php';
