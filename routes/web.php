<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        // return view('dashboard');
        // return Auth::user()->name;
        return redirect()->route('eventos.index');
    })->name('dashboard');
  });
  
  
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  
  Auth::routes();
  
  Route::get('eventos-tienda', [EventController::class,'tienda'])->name('eventos.tienda');
  
  Route::resource('eventos', EventController::class);

Route::resource('categorias', CategoryController::class);