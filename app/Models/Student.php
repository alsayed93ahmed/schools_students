<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class)->where('deleted_at', NULL);
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek());
    }
}
