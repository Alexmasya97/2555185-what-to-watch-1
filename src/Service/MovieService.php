<?php
namespace App\Service;

use App\Entity\Movie;  // Добавьте этот use
use App\Interface\MovieRepositoryInterface;

/**
 * Сервис для работы с фильмами
 */
class MovieService
{
  private MovieRepositoryInterface $repository;

  public function __construct(MovieRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Получение фильма по IMDB ID.
   *
   * @param string $imdbId
   * @return Movie|null
   */
  public function getMovieByImdbId(string $imdbId): ?Movie
  {
    return $this->repository->findByImdbId($imdbId);
  }

  /**
   * Получение фильма в виде массива
   *
   * @param string $imdbId
   * @return array|null
   */
  public function getMovieAsArray(string $imdbId): ?array
  {
    $movie = $this->getMovieByImdbId($imdbId);

    if (!$movie) {
      return null;
    }

    return [
      'imdbId' => $movie->getImdbId(),
      'title' => $movie->getTitle(),
      'year' => $movie->getYear(),
      'plot' => $movie->getPlot(),
      'poster' => $movie->getPoster(),
      'genre' => $movie->getGenre(),
    ];
  }
}
