<?php

namespace App\Services;

interface UserService
{
     
     /* untuk login memerlukan user? dan password? balikan boolean  */
     function login( string $email , string $password): bool;

}