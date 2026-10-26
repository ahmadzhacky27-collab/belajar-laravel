<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;

Route::get('/', function () {
    return view('welcome');
});

//
Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah');
Route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');
Route::get('kurang', [BelajarController::class, 'kurang'])->name('kurang');
Route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');
Route::get('kali', [BelajarController::class, 'kali'])->name('kali');
Route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');
Route::get('bagi', [BelajarController::class, 'bagi'])->name('bagi');

