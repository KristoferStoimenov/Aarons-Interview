<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ShiftController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Employees
Route::get('/employees/index',[EmployeeController::class, 'index'])->name('index.employees');
Route::get('/employees/details/{employee_name}',[EmployeeController::class, 'detailed_view'])->name('detail.employee');


//Shifts
Route::get('/shifts/index',[ShiftController::class, 'index'])->name('index.shifts');
Route::get('/create/shift', [ShiftController::class, 'create'])->name('create.shift');
Route::post('/store/shift/{id?}', [ShiftController::class, 'store'])->name('store.shift');
Route::get('/edit/shift/{id}', [ShiftController::class, 'edit'])->name('edit.shift');
Route::put('/update/shift/{id}', [ShiftController::class, 'update'])->name('update.shift');
Route::delete('/delete/shift/{id}', [ShiftController::class, 'delete'])->name('delete.shift');
Route::post('/shifts/import', [ShiftController::class, 'import'])->name('import.shifts');
