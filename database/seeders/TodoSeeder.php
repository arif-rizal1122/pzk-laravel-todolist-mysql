<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Todo::create([
            "id" => "1",
            "todo" => "arif"
        ]);

        Todo::create([
            "id" => "2",
            "todo" => "rizal"
        ]);



    }
}
