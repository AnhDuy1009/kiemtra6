<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';
    public $timestamps = false;

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_genre', 'id_genre', 'id_movie');
    }
}