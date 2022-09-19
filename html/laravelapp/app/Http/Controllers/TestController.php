<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
  public function req(Request $request)
  {
    return [
      '$request->ip()' => $request->ip(),
      '$_SERVER' => $_SERVER,
    ];
  }
}
