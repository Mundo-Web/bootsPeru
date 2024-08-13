<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ReCaptchaService extends BasicService
{
  static function verify($token)
  {
    
    $secret = env('NOCAPTCHA_SECRET');
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    try {
      $response = Http::asForm()->post($url, [
        'secret' => $secret,
        'response' => $token
      ]);
      $data = $response->json();
      return $data['success'];
    } catch (\Throwable $th) {
      return false;
    }
  }
}
