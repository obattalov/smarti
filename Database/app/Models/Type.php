<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'name',
    ];
    
    public function pokemons(): BelongsToMany
    {
        return $this->belongsToMany(Pokemon::class, 'type_pokemon')->distinct();
    }

}
