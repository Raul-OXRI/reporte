<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnlineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/online', [OnlineController::class, 'index'])->name('online.index');
Route::get('/online/pdf', [OnlineController::class, 'exportPDF'])->name('online.exportPDF');