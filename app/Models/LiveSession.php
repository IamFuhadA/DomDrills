<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'scheduled_at',
        'duration_minutes',
        'meeting_link',
        'recording_path',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'duration_minutes' => 'integer',
    ];

    public function isUpcoming(): bool
    {
        return $this->scheduled_at->isFuture();
    }
}
