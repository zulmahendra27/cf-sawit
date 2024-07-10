<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function knowledgebases(): HasMany
    {
        return $this->hasMany(Knowledgebase::class);
    }

    public function consulations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }
}
