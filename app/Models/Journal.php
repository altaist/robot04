<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Journal extends Model
{
    use HasFactory;

    protected $table = "journal";

    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id'
    ];

    public function journalable()
    {
        return $this->morphTo();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
