<?php

namespace App\Repositories;

use App\Models\Film;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class OmdbFilmRepository implements FilmRepositoryInterface
{
  private ClientInterface $httpClient;
  private RequestFactoryInterface $requestFactory;
  private string $apiKey;

  public function __construct(
    ClientInterface $httpClient,
    RequestFactoryInterface $requestFactory
  ) {
    $this->httpClient = $httpClient;
    $this->requestFactory = $requestFactory;
    $this->apiKey = env('OMDB_API_KEY');
  }

  /**
   *  фильм по IMDB ID через OMDB API
   *
   * @param string $imdbId
   * @return Film|null
   */
  public function findByImdbId(string $imdbId): ?Film
  {
    try {
      $request = $this->requestFactory->createRequest('GET',
        "http://www.omdbapi.com/?i={$imdbId}&apikey={$this->apiKey}"
      );

      $response = $this->httpClient->sendRequest($request);
      $data = json_decode($response->getBody()->getContents(), true);

      if ($data['Response'] === 'False') {
        return null;
      }

      // Создаем модель Film из данных API
      $film = new Film();
      $film->imdb_id = $data['imdbID'];
      $film->title = $data['Title'];
      $film->year = $data['Year'];
      $film->plot = $data['Plot'] ?? null;
      $film->poster = $data['Poster'] ?? null;
      $film->genre = explode(', ', $data['Genre'] ?? '');

      return $film;

    } catch (\Exception $e) {
      return null;
    }
  }
}
