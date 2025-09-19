<?php

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

Route::get('/', function () {
    return view('welcome');
    
});

Route::get('/peg', function () {
    return view('hrd.pegawai');    
}
);

Route::name('frog.')->group(function () {
    Route::get('/frogs', [App\Http\Controllers\controller_frog::class, 'index'])->name('index');
    Route::get('/frogs/create', [App\Http\Controllers\controller_frog::class, 'create'])->name('create');
    Route::post('/frogs', [App\Http\Controllers\controller_frog::class, 'store'])->name('store');
    Route::get('/frogs/{id}/edit', [App\Http\Controllers\controller_frog::class, 'edit'])->name('edit');
    Route::put('/frogs/{id}', [App\Http\Controllers\controller_frog::class, 'update'])->name('update');
    Route::delete('/frogs/{id}', [App\Http\Controllers\controller_frog::class, 'destroy'])->name('destroy');
    Route::post('/frogs/restore-all', [App\Http\Controllers\controller_frog::class, 'restoreAll'])->name('restoreAll');
});
