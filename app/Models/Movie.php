<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'pelicula';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idpelicula';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'genero',
        'duracion',
        'resumen',
        'director',
        'urlubicacion',
        'clasificacion',
        'anioestreno',
    ];
}
