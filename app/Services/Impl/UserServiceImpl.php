<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserServiceImpl implements UserService
{

    /* setelah dibuat dependency injection nya sekarang registerasikan di ServiceProvider nya */


    function login(string $email, string $password): bool
    {
    // Auth::attempt = coba melakukan login dengan mengunakan attempt,
    // attempt ini dapat mendeteksi jika password maka kode nya akan di hasshing otomatis sama laravel ny

     return Auth::attempt([
        "email" => $email,
        "password" => $password
       ]);
  
    }

}