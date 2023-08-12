<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypesController extends Controller
{
    public function index(Request $request) {
      
        return response(Type::whereHas('pokemons')->get()->toJson(), 200)
                  ->header('Content-Type', 'application/json');
    }  
}