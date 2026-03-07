<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Добавлена точка с запятой

class AuthController extends Controller // Открытие класса
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(): \Illuminate\Http\Response // Исправлено объявление типа
  {
    return response('this is Auth');
  }

  public function register()
  {
    // TODO: Implement register method
  }

  public function login()
  {
    // TODO: Implement login method
  }

  public function logout()
  {
    // TODO: Implement logout method
  }
} // Закрытие класса
