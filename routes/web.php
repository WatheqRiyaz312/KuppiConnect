<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Livewire\AdminProduct;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorLoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
})->name('index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// user routes
Route::middleware(['auth', 'userMiddleware'])->group(function () {

    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
});

// admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::get('/services', function () {
    return view('services');
})->name('services');


Route::get('/products', function () {
    return view('products');
})->name('products');

Route::middleware(['auth'])->group(function () {
    Route::get('admin/admin/manageProduct', function () {
        return view('admin.manageProduct');
    })->name('admin.manageProduct');
});


// Student Registration and Login
Route::view('/loginTut', 'loginTut')->name('loginTut');
Route::view('/registerTut', 'registerTut')->name('registerTut');


// Authentication Routes for Tutors
Route::get('/registerTutor', [AuthController::class, 'showTutorRegistrationForm'])->name('registerFormTutor');
Route::post('/registerTutor', [AuthController::class, 'registerTutor'])->name('registerTut');


//login to tutor dashboard
Route::get('/tutor/login', [TutorLoginController::class, 'showTutorDashboardLoginForm'])->name('tutorDashboardLogin');
Route::post('/tutor/login', [TutorLoginController::class, 'tutorDashboardLogin'])->name('tutorloginSubmit');
Route::get('/tutor/dashboard', function () {
    return view('tutorDashboard');
})->name('tutorDashboard');


Route::get('/tutors', function () {
    return view('tutors');
})->name('tutors');

//tutor profile cards
Route::get('/tutors', [TutorController::class, 'getAllTutors'])->name('tutors');

Route::middleware('auth:tutor')->get('/tutor/profile', [TutorController::class, 'showProfile'])->name('showTutorProfile');

Route::get('/tutor/dashboard', [TutorController::class, 'showDashboard'])->name('tutorDashboard');

Route::get('/tutor/{tutor_id}', [TutorController::class, 'showProfile'])->name('tutorProfile');

Route::post('tutor/logout', function () {
    // Check if the tutor is logged in
    if (Auth::guard('tutor')->check()) {
        Auth::guard('tutor')->logout();
        session()->flash('message', 'You are logged out as a tutor.');
    }

    // Redirect to home page
    return redirect()->route('index');
})->name('tutor.logout');

// Add module route
Route::post('/tutor/addModule', [ModuleController::class, 'store'])->name('tutorAddModule');

Route::post('/tutor/{tutor}/rate', [TutorController::class, 'submitRating'])
    ->middleware(['auth'])
    ->name('submit.rating');

    // Account Deactivated Route
Route::get('/account-deactivated', function () {
    return view('auth.account-deactivated');
})->name('account.deactivated');

// Admin Dashboard Route
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Admin Module Routes
Route::get('/admin/modules', [\App\Http\Controllers\Admin\AdminModuleController::class, 'index'])->name('admin.modules');

// Admin Student Routes
Route::get('/admin/students', [\App\Http\Controllers\Admin\AdminStudentController::class, 'index'])->name('admin.students');
Route::delete('/admin/students/{id}', [\App\Http\Controllers\Admin\AdminStudentController::class, 'destroy'])->name('admin.students.destroy');

// Admin Tutor Routes
Route::get('/admin/tutors', [\App\Http\Controllers\Admin\AdminTutorController::class, 'index'])->name('admin.tutors');
Route::delete('/admin/tutors/{id}', [\App\Http\Controllers\Admin\AdminTutorController::class, 'destroy'])->name('admin.tutors.destroy');



