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
Route::post('/register-school-admin', [App\Http\Controllers\HomeController::class, 'createSchool'])->name('registerSchoolAdmin');

/**
 * Master Admin
 */
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

/**
 * School Admin
 */
Route::get('/dashboard-school', [App\Http\Controllers\School\SchoolDashboard::class, 'index'])->name('requestSchool');
Route::post('/dashboard-school/submit-request-tutorial', [App\Http\Controllers\School\SchoolDashboard::class, 'store_tutorial'])->name('submitRequestTutorial');
Route::post('/dashboard-school/submit-request-resource', [App\Http\Controllers\School\SchoolDashboard::class, 'store_resource'])->name('submitRequestResource');
Route::get('/view-offers', [App\Http\Controllers\School\ViewOffers::class, 'index'])->name('viewOffers');
Route::get('/view-offers/view-offer-detail/{id}', [App\Http\Controllers\School\ViewOffers::class, 'view_offers'])->name('viewOffersDetail');
Route::get('/view-offers/view-offer-detail/accept-offer/{id}', [App\Http\Controllers\School\ViewOffers::class, 'accept_offer'])->name('acceptOffer');
Route::get('/view-offers/view-offer-detail/close-request/{id}', [App\Http\Controllers\School\ViewOffers::class, 'close_request'])->name('closeRequest');

/**
 * Volunteer
 */
Route::post('/register-volunteer', [App\Http\Controllers\RegisterVolunteer::class, 'store'])->name('registerVolunteer');
Route::get('/dashboard-volunteer', [App\Http\Controllers\Volunteer\VolunteerDashboard::class, 'index'])->name('dashboardVolunteer');
Route::get('/dashboard-volunteer/view-request-tutorial-detail/{id}', [App\Http\Controllers\Volunteer\VolunteerDashboard::class, 'view_detail_request_tutorial'])->name('viewDetailRequestTutorial');
Route::get('/dashboard-volunteer/view-request-resource-detail/{id}', [App\Http\Controllers\Volunteer\VolunteerDashboard::class, 'view_detail_request_resource'])->name('viewDetailRequestResource');
Route::post('/dashboard-volunteer/view-request-resource-detail/make-offer/{id}', [App\Http\Controllers\Volunteer\VolunteerDashboard::class, 'make_offer'])->name('makeOffer');
Route::get('/view-offers-volunteer', [App\Http\Controllers\Volunteer\VolunteerDashboard::class, 'view_offers'])->name('viewOffersVolunteer');



