<?php

use Illuminate\Support\Facades\Route;

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
    return view('admin/admin_layout');
});

//Route::get('/import_marks_excel', [App\Http\Controllers\ImportExcel::class, 'index'])->name('students.marks');

//Route::post('/import_marks_excel/import', [App\Http\Controllers\ImportExcel::class, 'import'])->name('students.maks');

//marks
Route::resource('/marks','App\Http\Controllers\MarksController');
Route::post('/import_marks','App\Http\Controllers\MarksController@import')->name('marks.import');

//students
Route::resource('/students','App\Http\Controllers\StudentsController');
Route::post('/import_students','App\Http\Controllers\StudentsController@import')->name('students.import');