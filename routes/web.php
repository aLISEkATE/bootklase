<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');

Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::put('/grades/{id}', [GradeController::class, 'update'])->name('grades.update');

Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

Route::get('/', function () { return view('index');});

Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
Route::get('/grades/{id}', [GradeController::class, 'show'])->name('grades.show');
Route::get('/grades/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit');


Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');

