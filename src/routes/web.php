<?php

use App\Http\Controllers\PublicAttendanceController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/evento/{slug}', [PublicAttendanceController::class, 'show'])->name('event.show');
Route::post('/evento/{slug}', [PublicAttendanceController::class, 'store'])->name('event.register');

Route::get('/admin/reportes/asistencias', [ReportController::class, 'export'])
    ->name('attendances.export')
    ->middleware(['auth']);

Route::get('/admin/reportes', [ReportController::class, 'export'])
    ->name('reports.form')
    ->middleware(['auth']);
