<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\UserEditController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/', [\App\Http\Controllers\HomeController::class, 'homepage'])->name('homepage');

Route::get('/dev', function () {
//    dd(Course::all());
    return redirect()->route('quiz.index');
});

Route::get('/', [App\Http\Controllers\Controller::class, 'index'])->name('home');

///////////////////////////////////////////////
//routes related to profile management
///////////////////////////////////////////////

Route::prefix('profile')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::get('/edit', [UserEditController::class, 'edit'])->name('profile.edit');
        Route::put('/update', [UserEditController::class, 'update'])->name('profile.update');
        Route::delete('/destroy/{id}', [UserEditController::class, 'destroy'])->name('profile.destroy');
        Route::get('/payments', [UserEditController::class, 'payments'])->name('profile.payments');
    });
});


///////////////////////////////////////////////
//routes related to course management
///////////////////////////////////////////////

Route::prefix('courses')->group(function () {

    Route::middleware(['auth'])->group(function () {
        //display blade for more info
        Route::get('/', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/{id}/display', [CourseController::class, 'display'])->name('courses.display');
        Route::get('/search', [CourseController::class, 'search'])->name('courses.search');
    });
    Route::middleware(['auth', 'role'])->group(function () {
        Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/show', [CourseController::class, 'show'])->name('courses.show');
        Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/update/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/{id}/destroy', [CourseController::class, 'destroy'])->name('courses.destroy');
    });
});

///////////////////////////////////////////////
/// routes related to token management
///////////////////////////////////////////////
Route::middleware(['auth', 'role'])
    ->group(function () {
        Route::resource('/api-token', TokenController::class);
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');
        Route::post('/analytics/show', [AnalyticsController::class, 'show'])->name('analytics.show');
    });


///////////////////////////////////////////////
//routes related to enrollment management
///////////////////////////////////////////////

Route::prefix('enroll')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/enroll/my_courses', [EnrollmentController::class, 'my_courses'])->name('enrollments.index');
        Route::get('/enroll/{course_id}', [EnrollmentController::class, 'enroll'])->name('enroll');
    });
});

///////////////////////////////////////////////
//routes related to quiz management
///////////////////////////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::resource('/quiz', QuizController::class);
});
///////////////////////////////////////////////
//routes related to tutorial management
///////////////////////////////////////////////
Route::middleware(['auth'])->group(function () {
    Route::resource('/tutorial', TutorialController::class);
});
///////////////////////////////////////////////
//routes related to notification management
///////////////////////////////////////////////
Route::middleware(['auth'])->prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});


///////////////////////////////////////////////
//Fallback route
///////////////////////////////////////////////
//Route::fallback(function () {
//    return redirect('/');
//});
