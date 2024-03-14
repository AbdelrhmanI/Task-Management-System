<?php

use App\Http\Controllers\CustomController;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[CustomController::class,'login']);

Route::get('/registration',[CustomController::class,'registration']);

Route::post('/register-user',[CustomController::class,'registerUser'])->name('register-user');

Route::post('/login-user',[CustomController::class,'loginUser'])->name('login-user');

Route::get('/dashboard',[CustomController::class,'dashboard'])->name('dashboard');

Route::get('/logout',[CustomController::class,'logout']);

Route::get('tasks/create',[CustomController::class,'create'])->name('create');

Route::post('/create-task',[CustomController::class,'createTask'])->name('create-task');

Route::get('/dashboard/{task}/edit',[CustomController::class,'editTask'])->name('task-edit');

Route::post('/dashboard/{task}/update', [CustomController::class, 'updateTask'])->name('update-task');

Route::delete('/dashboard/{task}', [CustomController::class, 'deleteTask'])->name('delete-task');

