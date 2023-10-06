<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Route::get('/', [\App\Http\Controllers\HomeController::class, 'homepage'])->name('homepage');

//Route::get('/dev', function () {
//    return dd(\App\Models\User::all());
//});

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('home');

// Route::get('/profile',[App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile')
    ->middleware([
        'auth',
        // 'role'
    ]);

Route::get('/profile/edit', [App\Http\Controllers\UserEditController::class, 'edit'])->name('edit')->middleware([
    'auth',
]);
Route::put('/profile/edit/update', [App\Http\Controllers\UserEditController::class, 'update'])->name('update')->middleware([
    'auth',
]);

Route::delete('/profile/destroy/{id}', [App\Http\Controllers\UserEditController::class, 'destroy'])->name('profile.destroy')->middleware([
    'auth',
]);

use App\Http\Controllers\CourseController;

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create')->middleware([
    'auth',
]);
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');

use App\Http\Controllers\EnrollmentController;

Route::get('/enroll/my_courses', [EnrollmentController::class, 'my_courses'])->name('enrollments.index')->middleware([
    'auth',
]);
Route::get('/enroll/{course_id}', [EnrollmentController::class, 'enroll'])->name('enroll')->middleware([
    'auth',
]);
