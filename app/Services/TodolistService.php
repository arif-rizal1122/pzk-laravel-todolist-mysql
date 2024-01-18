<?php


namespace App\Services;

interface TodolistService
{
    /* Fungsi ini mengembalikan nilai void, yang berarti fungsi ini tidak mengembalikan nilai apa pun. */
    public function saveTodo(string $id, string $todo): void;
    
    /* ambil data todolist nya */
    public function getTodolist(): array;

    public function removeTodo(string $todoId);

}