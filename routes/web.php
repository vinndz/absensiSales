<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\EmployeeDataController;

Route::get('/', [AbsensiController::class, 'index'])->name('index');
Route::get('/data-attendance', [AbsensiController::class, 'dataTable']);
Route::post('/submit-manpower', [AbsensiController::class, 'storeManual'])->name('submit.manual');
Route::get('/employee/{employeeId}', [AbsensiController::class, 'getEmployee']);
Route::post('/attendance/check-in', [AbsensiController::class, 'checkIn'])->name('attendance.checkin');
Route::post('/check-out', [AbsensiController::class, 'checkOut']);


Route::get('/employee-data', [EmployeeDataController::class, 'index'])->name('employee-data');
Route::get('/data-table', [EmployeeDataController::class, 'dataTable']);
Route::post('/employee-store', [EmployeeDataController::class, 'store'])->name('employee.store');

