<?php

use App\Http\Controllers\Controller;
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


Route::get('/', [Controller::class, 'index'])->name('galery');
Route::get('/completedb', [Controller::class, 'pokemonCompletedb'])->name('galery.completedb');
Route::get('/editor', [Controller::class, 'editor'])->name('editor');
Route::post('/editor', [Controller::class, 'pokemonActions']);
