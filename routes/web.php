<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;

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
})->name('/');

Auth::routes();

Route::get('/home', [UserController::class, 'index'])->name('home');




/* start User routes */

// User account
Route::get('/user', [UserController::class, 'index'])->name('user');

// Update user settings
Route::post('/user/update/${id}', [UserController::class, 'update'])->name('user.update');


/* end User routes */


/* start Admin routes */

// Admin panel home
Route::get('/admin/home/${id}', [AdminController::class, 'index'])->name('admin.home');

// View user
Route::get('/admin/view/user/${id}', [AdminController::class, 'user_view'])->name('admin.user.view');

// Promote admin
Route::get('/admin/promote/${id}', [AdminController::class, 'promote'])->name('admin.promote');

// Demote admin
Route::get('/admin/demote/${id}', [AdminController::class, 'demote'])->name('admin.demote');

// Delete user
Route::get('/admin/delete/user/${id}', [AdminController::class, 'delete_user'])->name('admin.delete.user');

// Create user
Route::get('/admin/create/user', [AdminController::class, 'create'])->name('admin.create');

// Store new user
Route::post('/admin/store/user', [AdminController::class, 'store'])->name('admin.store');

// Block user
Route::get('/admin/block/user/${id}', [AdminController::class, 'block'])->name('admin.block');

// Unblock user
Route::get('/admin/unblock/user/${id}', [AdminController::class, 'unblock'])->name('admin.unblock');


/* end Admin routes */

/* start Api routes */

// Api load / Update
Route::get('/api', [ApiController::class, 'index'])->name('api.index');

// Filter
Route::get('api/filter', [ApiController::class, 'filter'])->name('api.filter');


/* end Api routes */


/* start Api exports */

// Export data to csv file 
Route::get('/export_to_csv', [ApiController::class, 'export'])->name('export');

// Export data to csv file with current filter
Route::get('/export_to_csv_filter/{filter}', [ApiController::class, 'export_filter'])->name('export.filter');

/* end Api exports */