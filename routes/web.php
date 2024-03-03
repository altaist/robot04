<?php

use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\Lesson\LessonController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return view('robots');
});

Route::prefix('teacher')->group(function () {
    Route::get('journal', [JournalController::class, 'index']);
    Route::get('home', [CourseController::class, 'index'])->name('teacher.home');
    Route::get('course/{courseId}', [CourseController::class, 'show'])->name('teacher.course');
    Route::post('course', [CourseController::class, 'store'])->name('course.store');
    Route::post('course/{courseId}', [CourseController::class, 'update'])->name('course.update');

    Route::get('lesson/{lessonId}', [LessonController::class, 'show'])->name('teacher.lesson');
    Route::post('lesson', [LessonController::class, 'store'])->name('lesson.store');
    Route::post('lesson/{lessonId}', [LessonController::class, 'update'])->name('lesson.update');
    Route::post('lesson/{lessonId}/toggle', [LessonController::class, 'toggle'])->name('lesson.students.toggle');
    Route::post('lesson/{lessonId}/students/sync', [LessonController::class, 'syncStudents'])->name('lesson.students.sync');

    Route::get('student/{user}', [StudentController::class, 'show'])->name('teacher.student');
    Route::post('student', [StudentController::class, 'store'])->name('student.store');
    Route::put('student/{studentId}', [StudentController::class, 'update'])->name('student.update');
});

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/lk', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
