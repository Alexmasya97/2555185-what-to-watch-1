<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiResponse implements Responsable
{
  /**
   * @var mixed
   */
  protected $data;

  /**
   * @var int
   */
  public $statusCode;

  /**
   * ApiResponse constructor.
   *
   * @param mixed $data
   * @param int $statusCode
   */
  public function __construct($data = [], $statusCode = Response::HTTP_OK)
  {
    $this->data = $data;
    $this->statusCode = $statusCode;
  }

  /**
   * @param Request $request
   * @return JsonResponse
   */
  public function toResponse($request)
  {
    return response()->json($this->makeResponseData(), $this->statusCode);
  }

  /**
   * Преобразование возвращаемых данных к массиву.
   *
   * @return array
   */
  protected function prepareData()
  {
    if ($this->data instanceof Arrayable) {
      return $this->data->toArray();
    }

    if (is_array($this->data)) {
      return $this->data;
    }

    return (array) $this->data;
  }

  /**
   * Формирование содержимого ответа.
   *
   * @return array
   */
  abstract protected function makeResponseData();
}
