<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StripeController;
use App\Models\Category;
use App\Models\Event;
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

Route::get('/', );

Route::resource('/evento', EventController::class);
Route::get('/', [EventController::class, 'index']);
Route::resource('/category', CategoryController::class);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::patch('/updateUserRole', [RoleController::class, 'updateUserRole'])->name('updateUserRole');



Route::get('/organisateur/dashboard', [HomeController::class, 'organisateurDashboard'])->name('organisateurDashboard');
Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('adminDashboard');
Route::post('/evento/filtred', [EventController::class, 'filterByCategory'])->name('filterByCategory');


Route::post('/payement', [StripeController::class, 'stripe'])->name('stripe.get');
Route::post('/stripe', [StripeController::class, 'stripePost'])->name('stripe.post');







Route::get('/panier', [ReservationController::class, 'myTickets'])->name('myTickets');


Route::patch('/acceptEvent', [EventController::class, 'accept'])->name('acceptEvent');









Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
