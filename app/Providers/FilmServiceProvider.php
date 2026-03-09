<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\FilmRepositoryInterface;
use App\Repositories\OmdbFilmRepository;
use App\Services\FilmService;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;

class FilmServiceProvider extends ServiceProvider
{
  public function register()
  {
    // Регистрация HTTP клиента
    $this->app->bind(ClientInterface::class, function () {
      return Psr18ClientDiscovery::find();
    });

    // Регистрация фабрики запросов
    $this->app->bind(RequestFactoryInterface::class, function () {
      return Psr17FactoryDiscovery::findRequestFactory();
    });

    // Регистрация репозитория
    $this->app->bind(FilmRepositoryInterface::class, function ($app) {
      return new OmdbFilmRepository(
        $app->make(ClientInterface::class),
        $app->make(RequestFactoryInterface::class)
      );
    });

    // Регистрация сервиса как синглтон
    $this->app->singleton(FilmService::class, function ($app) {
      return new FilmService(
        $app->make(FilmRepositoryInterface::class)
      );
    });
  }

  public function boot()
  {
    //
  }
}
