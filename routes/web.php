<?php

use App\Http\Controllers\Movies\ImportController as MoviesImportController;
use App\Http\Controllers\MyCollection\ActionsController as MyCollectionActionsController;
use App\Http\Controllers\MyCollection\PagesController as MyCollectionPagesController;
use App\Http\Controllers\PagesController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Streamer\VideoStreamer;
use Inertia\Inertia;

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

Route::get('/', [PagesController::class, 'welcome'])->name('welcome');
Route::get(
    '/import',
    MoviesImportController::class
)->name('import');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('my-collection')->name('my-collection.')->group(function () {
        Route::get('/', [MyCollectionPagesController::class, 'index'])->name('index');
        Route::get('/setup', [MyCollectionPagesController::class, 'setup'])->name('setup');
        Route::post('/scan', [MyCollectionActionsController::class, 'scan'])->name('scan');
        Route::get('/play/{hash}', [MyCollectionPagesController::class, 'play'])->name('play');
        Route::get('/source/{hash}', [MyCollectionActionsController::class, 'source'])->name('source');
    });

});
