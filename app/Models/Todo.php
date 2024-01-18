<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $table = "todos";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $timestamps = true;

    protected $fillable = [
        "id",
        "todo"
    ];


}
