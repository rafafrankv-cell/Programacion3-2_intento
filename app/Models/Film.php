<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'film';
    protected $primaryKey = 'film_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'release_year',
        'language_id',
        'original_language_id',
        'rental_duration',
        'rental_rate',
        'length',
        'replacement_cost',
        'rating',
        'special_features',
    ];

    // Película ⇄ Actores (muchos a muchos)
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor', 'film_id', 'actor_id');
    }

    // Película ⇄ Categorías (muchos a muchos)
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'film_category', 'film_id', 'category_id');
    }

    // Película → Inventarios (1:N)
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'film_id', 'film_id');
    }

    // Película → Rentals (a través de inventory)
    public function rentals()
    {
        return $this->hasManyThrough(
            Rental::class,
            Inventory::class,
            'film_id',       // Foreign key en inventory
            'inventory_id',  // Foreign key en rental
            'film_id',       // Local key en film
            'inventory_id'   // Local key en inventory
        );
    }
}

