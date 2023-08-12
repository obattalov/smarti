<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Config;

class Controller extends BaseController
{
    public function create(Request $request) {
        $name = $request->input("name");
        if ($name != "") {
            $type = "";
            $response = \Http::post(Config('apis.DB_MODULE_URL') . "/pokemons/", compact('name'));
            return response($response, $response->status());
        }
          
        return response()->json(['message' => 'The Name is required']);
    }
    public function delete(Request $request) {
        $id = $request->input("id");
        if ($id != "") {
            $response = \Http::delete(Config('apis.DB_MODULE_URL') . "/pokemons/", ["id" => $id]);
            return response($response, $response->status());
            
        }
          
        return response()->json(['message' => 'Pokemon\'s id is required'], 400);
    }
}
