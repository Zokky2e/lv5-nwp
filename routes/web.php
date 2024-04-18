<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\LanguageMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');

Route::put('/users/{userId}/update-role', [UserController::class, 'updateRole'])->name('updateUserRole');

Route::post('/users/{user}/toggle-dropdown', [HomeController::class, 'toggleRoleDropdown'])->name('toggleRoleDropdown');

Route::group(['prefix' => '{locale}', 'where' => ['locale' => '[a-zA-Z]{2}']], function () {
    Route::get('/tasks', [TaskController::class, 'create'])->name('tasks.create');
    // Dodajte ostale rute prema potrebi
});
Route::resource('tasks', TaskController::class)->middleware(LanguageMiddleware::class);


Route::get('home/{locale}', [HomeController::class, 'switch'])->name('home.switch')->middleware(LanguageMiddleware::class);
