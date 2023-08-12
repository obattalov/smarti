<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonsController;
use App\Http\Controllers\TypesController;

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

Route::get('/pokemons/', [PokemonsController::class, 'index'])->name('pokemons.index');
Route::post('/pokemons/', [PokemonsController::class, 'create'])->name('pokemons.create');
Route::delete('/pokemons/', [PokemonsController::class, 'delete'])->name('pokemons.delete');
Route::get('/init/', [PokemonsController::class, 'init']);

Route::get('/types/', [TypesController::class, 'index'])->name('types.index');
