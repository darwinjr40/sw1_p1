<?php

use App\Http\Controllers\ApareceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PaperFileController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('eventos.index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('eventos.index');
    })->name('dashboard');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

Route::group(['middelware' => ['auth']], function () {

    Route::get('eventos-tienda', [EventController::class, 'tienda'])->name('eventos.tienda');

    Route::resource('eventos', EventController::class);

    Route::resource('categorias', CategoryController::class);

    Route::get('paper-index/{paper_id}', [PaperFileController::class, 'indexPaperFile'])->name('papers.indexFotografo');
    Route::post('paper-index', [PaperFileController::class, 'storeAparece'])->name('papers.storeAparece');
    Route::resource('papers', PaperFileController::class);
    
    Route::resource('aparece', ApareceController::class);
    Route::get('aparece-index-paper/{paper_id}', [ApareceController::class, 'inicioPaper'])->name('aparece.inicioPaper');
    Route::get('aparece-index-fotografo/{fotografo_id}/{invitado_id}', [ApareceController::class, 'mostrarFotografias'])->name('aparece.mostrarFotografias');
    Route::resource('ventas', VentaController::class);
    Route::post('ventas-store', [VentaController::class, 'preStore'])->name('ventas.preStore');
});
