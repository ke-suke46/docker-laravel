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
Route::get('todo', [TodoController::class, 'index'])->name('todo.index');
Route::get('todo/create',[TodoController::class, 'create'])->name('todo.create');
Route::post('todo', 'TodoController@store');
Route::get('todo/{id}', 'TodoController@show');
Route::get('todo/{id}/edit', 'TodoController@edit');
Route::put('todo/{id}', 'TodoController@update');
Route::delete('todo/{id}', 'TodoController@destroy');
});
