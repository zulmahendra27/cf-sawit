<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CfUser extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
