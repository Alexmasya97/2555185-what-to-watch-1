<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Repository\OmdbMovieRepository;
use App\Service\MovieService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;


$client = new Client();
$requestFactory = new HttpFactory();

$repository = new OmdbMovieRepository($client, $requestFactory);
$service = new MovieService($repository);

$movie = $service->getMovieByImdbId('tt3896198');  // Теперь возвращает объект Movie

if ($movie) {
  echo "Найден фильм:\n";
  echo "Название: " . $movie->getTitle() . "\n";
  echo "Год: " . $movie->getYear() . "\n";
  echo "Жанр: " . implode(', ', $movie->getGenre()) . "\n";
  echo "Описание: " . $movie->getPlot() . "\n";
  echo "Постер: " . $movie->getPoster() . "\n";
} else {
  echo "Фильм не найден\n";
}
