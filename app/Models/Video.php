<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_id',
        'provider',
        'video_id',
        'video_path',
        'duration',
        'size',
    ];

    protected $casts = [
        'duration' => 'integer',
        'size' => 'integer',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
