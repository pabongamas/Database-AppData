<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelUserMovieModel extends Model
{
    use HasFactory;

    protected $table = 'relusuariopelicula';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idusuario',
        'idpelicula',
        'calificacion'
    ];
}
