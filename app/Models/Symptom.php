<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Symptom extends Model
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

    public function cfusers(): HasMany
    {
        return $this->hasMany(CfUser::class);
    }
}
