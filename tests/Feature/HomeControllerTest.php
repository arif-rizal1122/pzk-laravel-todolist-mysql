<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testGuest()
    {
        /* jika session nya tidak ada maka redirect ke login  */
        $this->get('/')->assertSessionMissing("user")->assertRedirect("/login");
    }

    public function testMember()
    {
        /* session nya ada maka redirect ke todolist */
        $this->withSession([
            "user" => "arif"
        ])->get('/')
            ->assertRedirect("/todolist");
    }


}