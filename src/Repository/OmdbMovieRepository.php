<?php
namespace App\Repository;

use App\Entity\Movie;
use App\Interface\MovieRepositoryInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class OmdbMovieRepository implements MovieRepositoryInterface
{
  private ClientInterface $httpClient;
  private RequestFactoryInterface $requestFactory;
  private string $apiKey = '6a277066';

  public function __construct(
    ClientInterface $httpClient,
    RequestFactoryInterface $requestFactory
  ) {
    $this->httpClient = $httpClient;
    $this->requestFactory = $requestFactory;
  }

  public function findByImdbId(string $imdbId): ?Movie
  {
    $url = "http://www.omdbapi.com/?i={$imdbId}&apikey={$this->apiKey}";

    $request = $this->requestFactory->createRequest('GET', $url);
    $response = $this->httpClient->sendRequest($request);

    $data = json_decode($response->getBody()->getContents(), true);

    if (isset($data['Error']) || !isset($data['imdbID'])) {
      return null;
    }

    return new Movie(
      $data['imdbID'],
      $data['Title'],
      $data['Year'],
      $data['Plot'] ?? '',
      $data['Poster'] ?? '',
      explode(', ', $data['Genre'] ?? '')
    );
  }
}
