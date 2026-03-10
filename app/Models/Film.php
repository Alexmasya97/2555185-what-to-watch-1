<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
  protected $table = 'films';

  protected $fillable = [
    'imdb_id',
    'title',
    'year',
    'plot',
    'poster',
    'genre'
  ];

  protected $casts = [
    'genre' => 'array'
  ];

}
