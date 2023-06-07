<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplyPosition extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'society_id',
        'job_vacancy_id',
        'position_id',
        'job_apply_societies_id',
        'status',
    ];

    protected $casts = [
        'status' => ApplicationStatus::class,
    ];

    public function societies(): BelongsTo
    {
        return $this->belongsTo(Society::class);
    }

    public function jobVacancies(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function availablePosition(): BelongsTo
    {
        return $this->belongsTo(AvailablePosition::class, 'position_id', 'id');
    }

    public function jobApplySociety(): BelongsTo
    {
        return $this->belongsTo(JobApplySociety::class, 'job_apply_societies_id', 'id');
    }
}
