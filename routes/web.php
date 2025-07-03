<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DSController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TrackingApplicationController;
use App\Http\Controllers\TrackingController;;

use App\Http\Middleware\UserAuthCheck;

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

Route::middleware('check.userAuthCheck')->group(function () {
    Route::get('/run-commands',[UserController::class, 'runMigrations']);
    Route::match(['post', 'get'], '/admins/{id?}',                      [UserController::class, 'staff'])->name('staff');
    Route::match(['post', 'get'], '/users',                             [UserController::class, 'users'])->name('users');
    
    Route::match(['post', 'get'], '/client/add/{id?}',                  [ClientController::class, 'add'])->name('client.add');
    Route::match(['post', 'get'], '/client',                            [ClientController::class, 'index'])->name('client.index');
    Route::match(['post', 'get'], '/client/store/{id?}',                 [ClientController::class, 'store'])->name('client.store');
    Route::match(['post', 'get'], '/client/delete/{id?}',                [ClientController::class, 'delete'])->name('client.delete');
    Route::match(['post', 'get'], '/client/{id}',                        [ClientController::class, 'client_detail_page'])->name('client.detail');

    
    
});

//basic routes of login and registeration ...
Route::get('/',       [UserController::class, 'index'])->name('dashboard');
Route::get('/login',  [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

//Auth Controller... 
Route::match(['post', 'get'], '/forgot_password', [AuthController::class, 'forgot_password'])->name('forgot.password');
Route::match(['post', 'get'], '/change_password', [AuthController::class, 'change_password'])->name('change.password');
Route::match(['post', 'get'], '/register',        [AuthController::class, 'user_register'])->name('register.user');
Route::match(['post', 'get'], '/logout',          [AuthController::class, 'logout'])->name('logout');
Route::match(['post', 'get'], '/verify/{hash}',   [AuthController::class, 'verify'])->name('verify');



Route::get('/dashboard',function(){

    return view('pages.dashboard');
});


