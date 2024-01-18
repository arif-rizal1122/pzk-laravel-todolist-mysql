<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{

    private TodolistService $todoService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todoService = $todolistService;
    }
    
    public function todolist( Request $request)
    {
        $todolist = $this->todoService->getTodolist();
         return response()->view("todolist.todolist", [
            'tittle' => 'todolist',
            'todolist' => $todolist
         ]);
    }


    public function addTodolist(Request $request)
    {
         /* ambil semua todo */
         $todolist = $this->todoService->getTodolist();
         /* todo dari $request->input('todo') */
         $todo = $request->input('todo');
         /* Jika todo nya kosong  */
         if(empty($todo))
         {
            /* jalankan ini */
            return response()->view('todolist.todolist', [
                'tittle' => 'todolist',
                'todolist' => $todolist,
                'error'    => 'The Todo Is Required'     
            ]);
         }
         
        /* jika todo ada isinya simpan perubahan */ 
        /* ini akan secara otomatis menjeneret id otomatis(uniqid()) 
         uniqid():Fungsi ini menghasilkan string unik yang dapat digunakan sebagai ID untuk tugas baru. */
        $this->todoService->saveTodo(uniqid(), $todo);
        /* redirect ke action dari controller */
        return redirect()->action([TodolistController::class, 'todolist']);
        // return redirect()->view('todolist.todolist', [
            //     'tittle' => 'todolist',
            //     'todolist' => $todolist,
            //     'error'    => 'The Todo Is Required'     
            // ]);
    }


    public function removeTodolist(string $todoId)
    {
        
        /* HAPUS TODO YG ADA DI PARAMETER */
        $this->todoService->removeTodo($todoId);

        return redirect()->action([TodolistController::class, 'todolist']);
        
    }




}
