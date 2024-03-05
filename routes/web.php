<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
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
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('adminDashboard');
Route::post('/evento/filtred', [EventController::class, 'filterByCategory'])->name('filterByCategory');


Route::post('/payement', [StripeController::class, 'stripe'])->name('stripe.get');
Route::post('/stripe', [StripeController::class, 'stripePost'])->name('stripe.post');
