<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Lesson extends Model
{
    protected $casts = [
        'json_data' => 'object',
        'date_start' => 'datetime:Y-m-d H:i',
        'date_started_at' => 'datetime:Y-m-d H:i'
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function students(): MorphToMany
    {
        return $this->morphToMany(User::class, 'journalable', 'journal')->withTimestamps();
    }

    public function journalRecords(): MorphMany
    {
        return $this->morphMany(Journal::class, 'journalable')->withTimestamps();
    }

}
