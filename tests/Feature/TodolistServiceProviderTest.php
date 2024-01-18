<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Services\TodolistService;
use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class TodolistServiceProviderTest extends TestCase
{
    /* set up untuk cek dependency injection */
    private TodolistService $todolistService;

        protected function setUp(): void
        {
            parent::setUp();

            DB::delete("delete from todos");
            
            $this->todolistService = $this->app->make(TodolistService::class);
        }

        
        public function testTodolistNotNull()
        {
            self::assertNotNull($this->todolistService);
        }



        public function testSaveTodo()
        {
            $this->todolistService->saveTodo("1", "arif");

            $todolist = $this->todolistService->getTodolist();
 
           foreach($todolist as $value)
           {
               self::assertEquals("1", $value['id']);
               self::assertEquals("arif", $value['todo']);
           }

        }



        public function testTodolistEmpty()
        {
            /* KALAU DATA NYA KOSONG[] DARI ... */
            self::assertEquals([], $this->todolistService->getTodolist());
        }


        public function testGetTodolistNotEmpty()
        {
            $expected = [
                [
                    "id" => "1",
                    "todo" => "arif"
                ],
                [
                    "id" => "2",
                    "todo" => "rizal"
                ]
            ];
    
            $this->todolistService->saveTodo("1", "arif");
            $this->todolistService->saveTodo("2", "rizal");
            // adalah bagian dari unit testing yang digunakan untuk memastikan bahwa array $expected ada sebagai subset dari array yang dikeluarkan oleh metode getTodolist() dari service todolistService.  
            Assert::assertArraySubset($expected, $this->todolistService->getTodolist());
        }



        public function testRemoveTodo()
        {
            // $this->seed([TodoSeeder::class]);

            $this->todolistService->saveTodo("1", "arif");
            $this->todolistService->saveTodo("2", "rizal");
            
         self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

         // remove data todolist yg belum dibuat
         $this->todolistService->removeTodo("3");
         // jadi pastikan data nya gak ada yg terhapus karena id nya tidak ditemukan
         self::assertEquals(2, sizeof($this->todolistService->getTodolist()));
         // dihapus satu 
         $this->todolistService->removeTodo("1");
         // jadi pastikan data nya tinngal 1
         self::assertEquals(1, sizeof($this->todolistService->getTodolist()));
         // dihapus dua
         $this->todolistService->removeTodo("2");
         // jadi data gak ada 
         self::assertEquals(0, sizeof($this->todolistService->getTodolist()));

         
        }










        
}
