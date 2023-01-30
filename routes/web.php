<?php

use App\Http\Controllers\dashboard\CitiesController;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\RolesController;
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

Route::view('/', 'components.login.login')->name('login')->middleware('guest');
Route::view('home', 'dashboard.home.home')->name('home')->middleware('auth');
Route::view('retrieve', 'components.login.forgotten')->name('retrieve');
Route::view('profile', 'components.dashboard.users.profile')->name('profile');
Route::view('rolesView', 'components.dashboard.users.roles')->name('rolesView');


Route::controller(LoginController::class)->group(function() {
    Route::post('validate', 'validateCredentials')->name('validate');
    Route::post('logout', 'logOutSession')->name('logout');
    Route::post('passwordR', 'retrievePassword')->name('passwordR');
});

Route::controller(HomeController::class)->middleware('auth')->group(function() {
    Route::get('users', 'index')->name('users')->middleware('auth');
});

Route::controller(RolesController::class)->middleware('auth')->group(function() {
    Route::post('roles', 'getAllRoles')->name('roles');
    Route::post('createRole', 'create')->name('createRole');
    Route::post('editRoles', 'edit')->name('editRoles');
    Route::post('editRole', 'update')->name('editRole');
    Route::post('deleteRole', 'destroy')->name('deleteRole');
});

Route::controller(CitiesController::class)->middleware('auth')->group(function() {
    Route::get('cities', 'index')->name('cities');
});

