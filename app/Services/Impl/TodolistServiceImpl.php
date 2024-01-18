<?php
namespace App\Services\Impl;

use App\Models\Todo;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;

class TodolistServiceImpl implements TodolistService
{

   

   public function saveTodo(string $id, string $todo): void
   {

      /* siapkan table untuk diisi row nya */
       $todo = new Todo([
         "id" => $id,
         "todo" => $todo,
       ]);
       
       /* simpan perubahan */
       $todo->save();
   }





    public function getTodolist(): array
    {
    /*adalah bagian dari Laravel yang digunakan untuk mengambil semua data dari tabel todos dan mengembalikannya sebagai array.*/
    return Todo::query()->get()->toArray();
    }



    /* Fungsi removeTodo menerima satu parameter yaitu $todoId, yang merupakan ID dari tugas yang ingin dihapus. */
    public function removeTodo(string $todoId)
    {
        // ini adalah cara untuk mencari suatu record dalam tabel todos berdasarkan id-nya. find adalah metode yang disediakan oleh Laravel untuk mencari suatu record berdasarkan primary key-nya. Dalam hal ini, $todoId adalah primary key dari record yang ingin dicari.
         $todo = Todo::query()->find($todoId);

         if($todo != null){
           $todo->delete();
         }

    }


   }



