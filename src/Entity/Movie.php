<?php
namespace App\Entity;

class Movie
{
  private string $imdbId;
  private string $title;
  private string $year;
  private string $plot;
  private string $poster;
  private array $genre;

  public function __construct(
    string $imdbId,
    string $title,
    string $year,
    string $plot,
    string $poster,
    array $genre
  ) {
    $this->imdbId = $imdbId;
    $this->title = $title;
    $this->year = $year;
    $this->plot = $plot;
    $this->poster = $poster;
    $this->genre = $genre;
  }

  public function getImdbId(): string
  {
    return $this->imdbId;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function getYear(): string
  {
    return $this->year;
  }

  public function getPlot(): string
  {
    return $this->plot;
  }

  public function getPoster(): string
  {
    return $this->poster;
  }

  public function getGenre(): array
  {
    return $this->genre;
  }
}
