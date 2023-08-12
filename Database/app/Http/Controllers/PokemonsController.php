<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use App\Models\Type;

class PokemonsController extends Controller
{
    public function index(Request $request) {
        $pokemons = Pokemon::with(['types']);
        if ($name = $request->input('name')) {
            if (strlen($name) < 3) {
                response()->json(['message' => 'Search string for Name has to be at least 3 letters'], 400);
            }
            $pokemons->where('pokemons.name', 'LIKE', "%$name%");
        }
        if ($type = $request->input('type')) {
            $pokemons->whereHas('types', function($q) use ($type) {
                $q->where('id', '=', $type);
            });
        }
        return response($pokemons->get()->toJson(), 200)
                  ->header('Content-Type', 'application/json');
    }
    
    public function create(Request $request) {
        $name = $request->input('name');
        if (!$name) {
            return response()->json(['message' => 'Name field is required'], 400);
        }
        if (Pokemon::where('pokemons.name', '=', $name)->count()) {
            return response()->json(['message' => 'Pokemon with such a name allready exists'], 400);
        }
        Pokemon::create(['name' => $name])->save();
        return response()->json(['message' => 'Success'], 200);
    }
    
    public function delete(Request $request) {
        $id = $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'Empty id'], 400);
        }
        if (is_null(Pokemon::find($id))) {
            return response()->json(['message' => "No pokemon with id = {$id}"], 400);
        }
        Pokemon::find($id)->delete();
        return response()->json(['message' => 'Success'], 200);
    }
    
    public function init(Request $request) {
        set_time_limit(10);
        $db_connection = Config('database.default');
        $db_config = Config("database.connections.{$db_connection}");
        $exec = 'mysql -h ' . $db_config['host'] . ' -P ' . $db_config['port'] . ' -u' . $db_config['username'] . ($db_config['password'] ?' -p' . $db_config['password'] : '') . ' ' . $db_config['database'] . ' < ' . __DIR__ . '/../../../storage/app/data.sql';
        //dd($exec);
        try {
            $output = shell_exec( "php artisan migrate" . " 2>&1" ) . "\n";
            $output .= shell_exec( $exec . " 2>&1" );
            if (Pokemon::count()) {
                return redirect()->route('pokemons.index');
            }
        } catch (Exception $e) {
        }
        die("<pre>pupulating is failed\n" . print_r($output, true) . "\ntry to execute\n{$exec}\nin a command shell</pre>");
    }
    
}
