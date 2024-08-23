<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/', function () {
    return view('home');
});



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');



Route::middleware(['auth'])->group(function () {

    Route::get('/admin/index-users',  [AdminController::class, 'listUsers'])->name('listUsers');
    Route::get('/admin/roles/index', [UserRoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/create', [UserRoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/admin/roles', [UserRoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/admin/roles/{role}/edit', [UserRoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/admin/roles/{role}', [UserRoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/roles/edit/{role}', [UserRoleController::class, 'destroyRole'])->name('admin.roles.destroy');





    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/create', [AdminController::class, 'createUser'])->name('admin.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'gr'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
