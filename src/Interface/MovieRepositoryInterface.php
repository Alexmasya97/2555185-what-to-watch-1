<?php

namespace App\Interface;

use App\Entity\Movie;

interface MovieRepositoryInterface
{
  /**
   * Находит фильм по IMDB ID
   *
   * @param string $imdbId
   * @return Movie|null
   */
  public function findByImdbId(string $imdbId): ?Movie;
}
