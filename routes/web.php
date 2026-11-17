<?php

use App\Http\Controllers\{EquipmentController, ReportController};
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('auth')->group(function () {
    Route::resource('equipment', EquipmentController::class);

    Route::get('/reports',       [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf',   [ReportController::class, 'pdf'])->name('reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'excel'])->name('reports.excel');
});

require __DIR__.'/auth.php';