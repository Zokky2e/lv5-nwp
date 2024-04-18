<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');

Route::put('/users/{userId}/update-role', [UserController::class, 'updateRole'])->name('updateUserRole');

Route::post('/users/{user}/toggle-dropdown', [HomeController::class, 'toggleRoleDropdown'])->name('toggleRoleDropdown');
