<?php

namespace App\Services;

use App\Models\Film;
use App\Repositories\FilmRepositoryInterface;


class FilmService
{
  /**
   * @var FilmRepositoryInterface
   */
  private $repository;

  /**
   *
   * @param FilmRepositoryInterface $repository
   */
  public function __construct(FilmRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Получение фильма по IMDB ID из API.
   *
   * @param string $imdbId
   * @return Film|null
   */
  public function getFilmByImdbId(string $imdbId): ?Film
  {
    return $this->repository->findByImdbId($imdbId);
  }

  /**
   * Получение фильма в виде массива
   *
   * @param string $imdbId
   * @return array|null
   */
  public function getFilmAsArray(string $imdbId): ?array
  {
    $film = $this->getFilmByImdbId($imdbId);

    if (!$film) {
      return null;
    }

    // Для Eloquent модели используем прямой доступ к атрибутам
    return [
      'imdbId' => $film->imdb_id,
      'title' => $film->title,
      'year' => $film->year,
      'plot' => $film->plot,
      'poster' => $film->poster,
      'genre' => $film->genre,
    ];
  }

  /**
   * Сохранить фильм в БД
   *
   * @param array $data
   * @return Film
   */
  public function saveFilm(array $data): Film
  {
    return Film::create([
      'imdb_id' => $data['imdbId'],
      'title' => $data['title'],
      'year' => $data['year'],
      'plot' => $data['plot'] ?? null,
      'poster' => $data['poster'] ?? null,
      'genre' => $data['genre'] ?? []
    ]);
  }

  /**
   * Найти или создать фильм по IMDB ID
   *
   * @param string $imdbId
   * @return Film|null
   */
  public function findOrCreateFromApi(string $imdbId): ?Film
  {
    // Сначала ищем в БД
    $existingFilm = Film::where('imdb_id', $imdbId)->first();

    if ($existingFilm) {
      return $existingFilm;
    }

    // Если нет в БД, ищем через API
    $filmData = $this->getFilmAsArray($imdbId);

    if (!$filmData) {
      return null;
    }

    // Сохраняем в БД
    return $this->saveFilm($filmData);
  }
}
