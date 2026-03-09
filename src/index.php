<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Repositories\OmdbFilmRepository;
use App\Services\FilmService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;


$client = new Client();
$requestFactory = new HttpFactory();

$repository = new OmdbFilmRepository($client, $requestFactory);
$service = new FilmService($repository);

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
