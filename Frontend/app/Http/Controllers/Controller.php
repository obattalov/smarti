<?php

namespace App\Http\Controllers;

use Illuminate\Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Config;

class Controller extends BaseController
{
    const ALERT_COLOR = "#F00";
    const SUCCESS_COLOR = "#0F0";

    public function index(Request $request) {
        $data = $this->getPokemonsData();
        $filter = $request->all();
        return view('galery.index', compact('data', 'filter'));
    }

    public function editor(Request $request) {
        $data = $this->getPokemonsData(true);
        return view('editor.index', compact('data'));
    }
    
    public function pokemonActions(Request $request) {
        $action = "pokemon" . ucfirst($request->input('action'));
        if (!method_exists(get_class($this), $action)) {
            $message = [
              "message" => 'Incorrect action',
              "is_error" => true
            ];
            return $this->viewEditorPage($message);
        }

        return $this->$action($request);
    }
    
    private function pokemonCreate(Request $request) {
        $id = $request->input('id');
        $message = [];

        $name = $request->input('name');
        if ($name == "") {
            $message = [
                "message" => "Pokemon's name required",
                "is_error" => true
            ];
        } else {
            $response = \Http::post(Config('apis.EDITOR_MODULE_URL') . '/pokemons/', compact('name'));
            if ($response->status() != 200) {
                $result = json_decode($response, true);
                $message = [
                    "message" => $result["message"],
                    "is_error" => true
                ];
            } else {
                $message = [
                    "message" => "Successfully added",
                    "is_error" => false
                ];
            }
        }
        
        return $this->viewEditorPage($message);
    }

    private function pokemonDelete(Request $request) {
        $id = $request->input('id');
        if ($id != 0) {
            $response = \Http::delete(Config('apis.EDITOR_MODULE_URL') . '/pokemons/', compact('id'));
            if ($response->status() != 200) {
                $result = json_decode($response, true);
                $message = [
                    "message" => $result["message"],
                    "is_error" => true
                ];
            } else {
                $message = [
                    "message" => "Successfully removed",
                    "is_error" => false
                ];
            }
        } else {
            $message = [
                "message" => "Pokemon's ID required",
                "is_error" => true
            ];
        }
        return $this->viewEditorPage($message);
    }
  
    private function viewEditorPage($messageParams) {
        $data = array_merge($this->getPokemonsData(true), $messageParams);
        $data["messageColor"] = $messageParams['is_error'] ? self::ALERT_COLOR : self::SUCCESS_COLOR;
        return view('editor.index', compact('data'));    
    }

    /**
     * Get pokemons list from pokemons api.
     *
     * @param  bool  $useBaseUrl // use base pokemons api url (without parameters)
     */    
    private function getPokemonsData($useBaseUrl = false) {
        $data = json_decode(\Http::get(Config('apis.GALERY_MODULE_URL') . ($useBaseUrl ? "" : $_SERVER["REQUEST_URI"])), true);
        if (isset($data["pokemons"])) {
            foreach($data["pokemons"] as &$pokemon) {
                $types = [];
                foreach($pokemon["types"] as $type) $types []= $type["name"];
                $pokemon["types"] = $types;
            }
        } else {
            $data["pokemons"] = [];
        }
        return $data;
    }

}
