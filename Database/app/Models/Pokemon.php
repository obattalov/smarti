<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pokemon extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public $table = "pokemons";
    
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'image',
        'weight',
    ];
    
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'type_pokemon')->distinct();
    }
}
