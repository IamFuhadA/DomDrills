<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'slug',
        'description',
        'content',
        'order',
        'duration_minutes',
    ];

    protected $casts = [
        'order' => 'integer',
        'duration_minutes' => 'integer',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function video(): HasOne
    {
        return $this->hasOne(Video::class);
    }

    public function progresses(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function isCompletedBy(User $user): bool
    {
        return $this->progresses()->where('user_id', $user->id)->whereNotNull('completed_at')->exists();
    }
}
