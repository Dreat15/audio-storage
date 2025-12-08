<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioController;

Route::get('/', [AudioController::class, 'index'])->name('upload.form');
Route::post('/upload', [AudioController::class, 'upload'])->name('upload.file');
Route::get('/play/{id}', [AudioController::class, 'play'])->name('audio.play');
Route::get('/list', [AudioController::class, 'list'])->name('audio.list');
Route::delete('/audio/{id}', [AudioController::class, 'destroy'])->name('audio.destroy');