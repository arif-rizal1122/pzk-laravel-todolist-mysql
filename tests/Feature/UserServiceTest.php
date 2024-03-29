<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp():void
    {
        parent::setUp();

        DB::delete("delete from users");

        $this->userService = $this->app->make(UserService::class);
    }
    /*_________________ LOGIN ___________________*/ 
    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        self::assertTrue($this->userService->login("arif@gmail.com", "buka1122"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("eko", "eko"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("arif@gmail.com", "salah"));
    }


    /*_________________ REGISTER ___________________*/ 

    public function testRegisterSuccess()
    {


        
    }

}