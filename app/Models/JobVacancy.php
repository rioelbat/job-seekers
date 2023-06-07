<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobVacancy extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_category_id',
        'company',
        'address',
        'description',
    ];

    public function jobCategory(): BelongsTo
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function availablePositions(): HasMany
    {
        return $this->hasMany(AvailablePosition::class);
    }

    public function jobApplyPositions(): HasMany
    {
        return $this->hasMany(JobApplyPosition::class);
    }
}
