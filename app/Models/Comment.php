<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

  protected $fillable = [
    'text',
    'rating',
    'film_id',
    'user_id',
    'parent_id',
    'is_external',
    'external_author',
  ];

  protected $casts = [
    'rating' => 'integer',
    'is_external' => 'boolean',
  ];

  public function film():BelongsTo
  {
    return $this->belongsTo(Film::class);
  }

  public function user():BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function parent():BelongsTo
  {
    return $this->belongsTo(Comment::class, 'parent_id');
  }


}
