<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnlineController;



Route::get('/', [OnlineController::class, 'index'])->name('online.index');
Route::get('/online/pdf', [OnlineController::class, 'exportPDF'])->name('online.exportPDF');
Route::get('/online/pdf-all', [OnlineController::class, 'exportPDFAll'])->name('online.exportPDFAll');
