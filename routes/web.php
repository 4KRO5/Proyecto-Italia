<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssistancesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\MembershipsController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\LectionsController;

Route::middleware(['auth'])->group(function () {
        /////////////////////////// User Routes ///////////////////////////
        Route::get('/users', [UsersController::class, 'index']);
        Route::post('/users', [UsersController::class, 'create']);
        Route::post('/users/restore/{id}', [UsersController::class, 'restore']);
        Route::get('/users/{id}', [UsersController::class, 'show']);
        Route::put('/users/{id}', [UsersController::class, 'update']);
        Route::delete('/users/{id}', [UsersController::class, 'destroy']);

        /////////////////////////// Payment Routes ///////////////////////////
        Route::get('/payments', [PaymentsController::class, 'index']);
        Route::post('/payments', [PaymentsController::class, 'create']);
        Route::post('/payments/restore/{id}', [PaymentsController::class, 'restore']);
        Route::post('/payments/{id}', [PaymentsController::class, 'paymentsByUser']);
        Route::put('/payments/{id}', [PaymentsController::class, 'update']);
        Route::delete('/payments/{id}', [PaymentsController::class, 'destroy']);

        /////////////////////////// Membership Routes ///////////////////////////
        Route::get('/memberships', [MembershipsController::class, 'index']);
        Route::post('/memberships', [MembershipsController::class, 'create']);
        Route::get('/memberships/{id}', [MembershipsController::class, 'show']);
        Route::put('/memberships/{id}', [MembershipsController::class, 'update']);
        Route::delete('/memberships/{id}', [MembershipsController::class, 'destroy']);

        /////////////////////////// Instructor Routes ///////////////////////////
        Route::get('/instructors', [InstructorsController::class, 'index']);
        Route::post('/instructors', [InstructorsController::class, 'create']);
        Route::post('/instructors/restore/{id}', [InstructorsController::class, 'restore']);
        Route::get('/instructors/{id}', [InstructorsController::class, 'show']);
        Route::put('/instructors/{id}', [InstructorsController::class, 'update']);
        Route::delete('/instructors/{id}', [InstructorsController::class, 'destroy']);

        /////////////////////////// Lection Routes ///////////////////////////
        Route::get('/lections', [LectionsController::class, 'index']);
        Route::post('/lections', [LectionsController::class, 'create']);
        Route::get('/lections/{id}', [LectionsController::class, 'show']);
        Route::post('/lections/{id}', [LectionsController::class, 'lectionsByUser']);
        Route::POST('/register-assistance/{id}', [LectionsController::class, 'registerAssistance']);
        Route::put('/lections/{id}', [LectionsController::class, 'update']);
        Route::delete('/lections/{id}', [LectionsController::class, 'destroy']);

        /////////////////////////// Home Routes ///////////////////////////
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/search', [SearchController::class, 'search']);
});

//Login y logout
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

//Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');