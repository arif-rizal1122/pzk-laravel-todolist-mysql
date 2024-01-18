<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
     protected function setUp(): void
     {
         parent::setUp();
         DB::delete("delete from users");

     }



     public function testLoginPage()
     {
        $this->get('/login')->assertStatus(200)->assertSeeText("login");
     }




     public function testLoginSuccess()
     {
        $this->seed([UserSeeder::class]);

         $this->post('/doLogin', [
           /* cek validasi request */ 
            'user' => 'arif@gmail.com',
            'password' => 'buka1122'
           /* cek redirect kemana */ 
         ])->assertRedirect('/')
           /* ada session */
           ->assertSessionHas("user","arif@gmail.com");
     }




     public function testLoginValidationError()
     {
        $this->post('/doLogin', [])
        ->assertSeeText("user or password is required");
     }


     public function testLoginFailed()
     {
        $this->post('/doLogin', [
            'user' => "ereiw",
            'password' => "eiorjfeio"
        ])->assertSeeText('username or password wrong');
     }


     public function testLogoutUser()
     {
        /* kirim data seesion karena yg bisa logout adalah orang yg pernah login */
        $this->withSession([
            "user" => "arif"
        ])->post('/logout')->assertSessionMissing("user")->assertRedirect("/");
     }


     
   /*    middleware    */
     
   /*  */
     public function testMiddlewareOnlyGuestLoginPageForMember()
     {
          $this->withSession([
            'user' => "arif"
          ])->get('/login')->assertRedirect("/");
     }


     /* jika sudah login */ 
     public function testUserAllreadyLogin()
     {
          $this->withSession([
            'user' => "arif"
          ])->get('/login', [
            "user" => "arif",
            "password" => "buka1122"
          ])->assertRedirect("/");
     }


     public function testLogoutMemberMiddleware()
     {
         $this->post('/logout')
         ->assertRedirect("/")
         ->assertSessionMissing("user");
     }


     /*  */
     public function testLogoutGuestMIDDLE()
     {
       $this->post('/logout')->assertRedirect("/");
     }


}
