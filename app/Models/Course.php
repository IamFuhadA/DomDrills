<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_path',
        'published',
        'order',
    ];

    protected $casts = [
        'published' => 'boolean',
        'order' => 'integer',
    ];

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('order');
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }
}
