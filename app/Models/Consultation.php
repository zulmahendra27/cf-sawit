<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['disease'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function log(): BelongsTo
    {
        return $this->belongsTo(Log::class);
    }

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    public function cfusers(): HasMany
    {
        return $this->hasMany(CfUser::class);
    }
}
