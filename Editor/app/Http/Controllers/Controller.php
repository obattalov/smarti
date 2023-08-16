<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Config;

class Controller extends BaseController
{
    public function create(Request $request) {
        $data = $request->all();
        if (isset($data['name']) && $data['name'] != "") {
            $adapter = Config('adapter');
            $newData = [];
            foreach ($data as $k => $v) {
                if (isset($adapter[$k])) {
                    $newData[$adapter[$k]] = $v;
                }
            }
//            return response()->json(['message' => json_encode($newData)], 400);
            $response = \Http::post(Config('apis.DB_MODULE_URL') . "/pokemons/", $newData);
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
    public function completedb(Request $request) {
        $response = \Http::get(Config('apis.DB_MODULE_URL') . "/init/");
        return response($response, $response->status());
    }
}
