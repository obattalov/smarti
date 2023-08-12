<?php

namespace App\Http\Controllers;

use Illuminate\Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Config;

class Controller extends BaseController
{
    
    public function index(Request $request) {
        $inputs = $request->all();
        $adapterFields = Config('adapter');
        $filter = [];
        foreach ($inputs as $k => $v) {
            if (array_key_exists($k, $adapterFields)) {
                $filter[$adapterFields[$k]] = $v;
            }
        }
        if ($filter) {
            $query = '?' . http_build_query($filter);
        } else {
            $query = '';
        }
        $types = json_decode(\Http::get(Config('apis.DB_MODULE_URL') . "/types"), true);
        $pokemons = json_decode(\Http::get(Config('apis.DB_MODULE_URL') . "/pokemons/{$query}"), true);

        return response(json_encode(compact('pokemons', 'types')), 200)
                  ->header('Content-Type', 'application/json');        
      
      
      
    }
}
