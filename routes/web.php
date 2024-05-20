<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/', function () {
        return view('document.index');
    });

    Route::prefix('document')->group(function () {
        Route::get('/get', [App\Http\Controllers\Document\DocumentController::class, 'getDocuments'])->name('documents.get');
        Route::get('/get/{id}', [App\Http\Controllers\Document\DocumentController::class, 'getDocumentById'])->name('document.get');
        Route::get('/types/get', [App\Http\Controllers\Document\DocumentController::class, 'getTypes'])->name('document.type.get');
        Route::get('/processes/get', [App\Http\Controllers\Document\DocumentController::class, 'getProcess'])->name('document.process.get');
        Route::post('/store', [App\Http\Controllers\Document\DocumentController::class, 'store'])->name('document.store');
        Route::delete('/delete/{id}', [App\Http\Controllers\Document\DocumentController::class, 'destroy'])->name('document.destroy');
        Route::post('/update/{id}', [App\Http\Controllers\Document\DocumentController::class, 'update'])->name('document.update');
    });

});
