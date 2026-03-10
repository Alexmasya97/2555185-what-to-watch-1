<?php

namespace App\Http\Responses;

use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class SuccessResponse extends ApiResponse
{
  public function __construct($data = [], $statusCode = Response::HTTP_OK)
  {
    parent::__construct($data, $statusCode);
  }

  protected function makeResponseData(): array
  {
    // Обработка пагинации
    if ($this->data instanceof LengthAwarePaginator) {
      return [
        'data' => $this->data->items(),
        'current_page' => $this->data->currentPage(),
        'first_page_url' => $this->data->url(1),
        'next_page_url' => $this->data->nextPageUrl(),
        'prev_page_url' => $this->data->previousPageUrl(),
        'per_page' => $this->data->perPage(),
        'total' => $this->data->total(),
      ];
    }

    // Обычный ответ с данными
    return ['data' => $this->prepareData()];
  }
}
