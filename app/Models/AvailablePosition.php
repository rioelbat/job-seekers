<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AvailablePosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'job_vacancy_id',
        'position',
        'capacity',
        'apply_capacity',
    ];

    protected $hidden = [
        'id',
        'job_vacancy_id',
    ];

    public function jobVacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function jobApplyPositions(): HasMany
    {
        return $this->hasMAny(JobApplyPosition::class, 'position_id', 'id');
    }
}
