<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

// Public Pages
Route::get('/', function () {
    return view('index');
});

// Auth Routes
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

// 👨‍🏫 Teacher-only Routes
Route::middleware(['auth', 'role:teacher'])->group(function () {
    // Create Routes
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');

    Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');

    Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');

    // Update Routes
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::put('/subjects/{id}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::put('/grades/{id}', [GradeController::class, 'update'])->name('grades.update');

    // Delete Routes
    Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    Route::delete('/grades/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');
});

// Shared Routes (students + teachers)
Route::middleware(['auth'])->group(function () {
    // View Grades
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/grades/{id}', [GradeController::class, 'show'])->name('grades.show');
    Route::get('/grades/{id}/edit', [GradeController::class, 'edit'])->name('grades.edit'); // Optional if only for teachers

    // View Students
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit'); // Optional if only for teachers

    // View Subjects
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('/subjects/{id}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::get('/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit'); // Optional if only for teachers
});
