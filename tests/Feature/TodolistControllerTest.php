<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from todos");
    }

    public function testGetTodolist()
    {
        $this->seed([TodoSeeder::class]);

        $this->withSession([
            "user" => "arife",
        ])->get('/todolist')->assertSeeText("1")
                            ->assertSeeText("2")
                            ->assertSeeText("arif")
                            ->assertSeeText("rizal");

    }




    public function testAddTodolistFailed()
    {
        $this->withSession([
            "user" => "tes",
        ])->post("/todolist", [])->assertSeeText("The Todo Is Required");

    }



    public function testAddTodolistSuccess()
    {
       $this->withSession([
          "user" => "wqrokwe"
       ])->post("/todolist", [
          "todo" => "erij",
       ])->assertRedirect("/todolist");
    }



    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "acep",
            "todolist" => [
            [
                'id' => '1',
                'todo' => 'arif'
            ],
            [
                'id' => '2',
                'todo' => 'rizal'
            ],
         ]  
      ])->post("/todolist/1/delete")->assertRedirect("/todolist");
    }


}
