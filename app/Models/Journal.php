<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $table = "journal";

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id'
    ];
}
