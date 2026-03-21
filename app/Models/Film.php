<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
  protected $table = 'films';

  protected $fillable = [
    'imdb_id',
    'title',
    'poster_image',
    'preview_image',
    'background_image',
    'background_color',
    'video_link',
    'preview_video_link',
    'description',
    'rating',
    'scores_count',
    'director',
    'run_time',
    'released',
    'status_id',
    'is_promo',
    'created_by',
  ];

  protected $casts = [
    'is_promo' => 'boolean',
    'rating' => 'decimal:1',
    'released' => 'integer',
    'run_time' => 'integer',
    'scores_count' => 'integer',
  ];

  public function genres():BelongsToMany
  {
    return $this->belongsToMany(Genre::class, 'film_genre');
  }

  public function actors():BelongsToMany
  {
    return $this->belongsToMany(Actor::class, 'film_actor');
  }

  public function comments():HasMany
  {
    return $this->hasMany(Comment::class);
  }

  public function favoritedBy():BelongsToMany
  {
    return $this->belongsToMany(User::class, 'favorites');
  }

}
