<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\School::class, 'index'])->name('dashboardSchool');
Route::post('/register-school', [App\Http\Controllers\School::class, 'store'])->name('registerSchool');
Route::get('/register-school/create-account/{id}', [App\Http\Controllers\School::class, 'createAccount'])->name('makeSchoolAccount');
Route::post('/register-school/create-account/{id}', [App\Http\Controllers\School::class, 'storeAccount'])->name('createSchoolAccount');
Route::get('/register-school/edit/{id}', [App\Http\Controllers\School::class, 'edit'])->name('editSchool');
Route::post('/register-school/update/{id}', [App\Http\Controllers\School::class, 'update'])->name('updateSchool');
Route::get('/register-school/delete/{id}', [App\Http\Controllers\School::class, 'destroy'])->name('deleteSchool');

Route::get('/manage-users', [App\Http\Controllers\Users::class, 'index'])->name('manageUsers');
Route::get('/manage-users/{id}', [App\Http\Controllers\Users::class, 'edit'])->name('editUserAccount');
Route::post('/manage-users/update/{id}', [App\Http\Controllers\Users::class, 'update'])->name('updateUserAccount');
Route::get('/manage-users/delete/{id}', [App\Http\Controllers\Users::class, 'destroy'])->name('deleteUserAccount');

Route::post('/register-school-admin', [App\Http\Controllers\HomeController::class, 'createSchool'])->name('registerSchoolAdmin');

Route::post('/register-volunteer', [App\Http\Controllers\RegisterVolunteer::class, 'store'])->name('registerVolunteer');
