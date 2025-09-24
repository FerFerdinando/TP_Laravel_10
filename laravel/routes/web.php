<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\controller_frog::class, 'index'])->name('frog.index');

Route::get('/peg', function () {
    return view('hrd.pegawai');    
}
);

Auth::routes(['verify' => false, 'reset' => false]);

Route::middleware('auth')->group(function () {
    Route::name('frog.')->group(function () {
        Route::get('/create', [App\Http\Controllers\controller_frog::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\controller_frog::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\controller_frog::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\controller_frog::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\controller_frog::class, 'destroy'])->name('destroy');
        Route::post('/restore-all', [App\Http\Controllers\controller_frog::class, 'restoreAll'])->name('restoreAll');
    });
});
