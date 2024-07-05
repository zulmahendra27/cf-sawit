<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Knowledgebase extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['disease', 'symptom'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }

    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }
}
