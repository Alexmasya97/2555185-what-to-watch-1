<?php

namespace App\Http\Responses;

use Throwable;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse extends ApiResponse
{
  protected ?string $message;
  protected mixed $data;

  public function __construct($data = [], ?string $message = null, int $code = Response::HTTP_BAD_REQUEST)
  {
    $this->data = $data;
    $this->message = $message;

    parent::__construct([], $code);
  }

  /**
   * Создание ответа из исключения
   */
  public static function fromException(Throwable $e): self
  {
    // Определяем код ответа
    $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    $message = $e->getMessage();
    $errors = [];

    if ($e instanceof NotFoundHttpException) {
      $code = Response::HTTP_NOT_FOUND;
      $message = 'Запрашиваемая страница не существует.';
    } elseif ($e instanceof ValidationException) {
      $code = Response::HTTP_UNPROCESSABLE_ENTITY;
      $message = 'Переданные данные не корректны.';
      $errors = $e->errors();
    } elseif (method_exists($e, 'getStatusCode')) {
      $code = $e->getStatusCode();
    }

    return new self($errors, $message, $code);
  }

  protected function makeResponseData(): array
  {
    $response = ['message' => $this->message ?? 'Произошла ошибка'];

    if (!empty($this->data)) {
      $response['errors'] = $this->prepareData();
    }

    return $response;
  }

  protected function prepareData()
  {
    return $this->data;
  }
}
