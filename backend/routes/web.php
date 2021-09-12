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
    return view('welcome');
});
Route::get('todo', [TodoController::class,'index'])->name('todo.index');
Route::get('todo/create',[TodoController::class,'create'])->name('todo.create');
Route::post('todo', [TodoController::class,'store'])->name('todo.store');
Route::get('todo/{id}', [TodoController::class,'show'])->name('todo.show');
Route::get('todo/{id}/edit', [TodoController::class,'edit'])->name('todo.edit');
Route::put('todo/{id}', [TodoController::class,'update'])->name('todo.update');
Route::delete('todo/{id}', [TodoController::class,'destroy'])->name('todo.destroy');

