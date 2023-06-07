<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplySociety extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'society_id',
        'job_vacancy_id',
        'notes',
    ];

    public function societies(): BelongsTo
    {
        return $this->belongsTo(Society::class);
    }

    public function jobVacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function jobApplyPositions(): HasMany
    {
        return $this->hasMany(JobApplyPosition::class, 'job_apply_societies_id', 'id');
    }
}
