<?php

namespace App\Repositories;

use App\Models\Film;

interface FilmRepositoryInterface
{
  /**
   *  фильм по IMDB ID
   *
   * @param string $imdbId
   * @return Film|null
   */
  public function findByImdbId(string $imdbId): ?Film;
}
