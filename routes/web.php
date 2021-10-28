<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

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
    return view('home');
})->name('home');


Route::get('/about', function () {
    return view('about');
})->name('about-us');

Route::resource('todos', TodoController::class);

// https://127.0.0.1/todos/create - GET view('todos.create')    /views/todos/create.blade.php
// https://127.0.0.1/todos/store  - POST   action (store todo to db )

// https://127.0.0.1/todos/create

// 1. GET
// 2. POST 
 

// Route::get('/todos', [TodoController::class, 'index']);
// Route::get('/todos/{id}/show', [TodoController::class, 'show']);
// Route::get('/todos/create', [TodoController::class, 'create']);
// Route::post('/todos/store', [TodoController::class, 'store']);
// Route::get('/todos/edit', [TodoController::class, 'edit']);
// Route::put('/todos/update', [TodoController::class, 'update']);
// Route::delete('/todos/{id}/delete}', [TodoController::class, 'delete']);