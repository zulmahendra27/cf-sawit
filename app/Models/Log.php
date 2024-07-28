<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Log extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    // Relasi khusus untuk mendapatkan konsultasi dengan persentase tertinggi
    public function highestConsultation()
    {
        // return $this->hasOne(Consultation::class)->orderBy('percentage', 'desc');
        return $this->hasOne(Consultation::class)
            ->leftJoin('cf_users', 'consultations.id', '=', 'cf_users.consultation_id')
            ->select('consultations.*', \DB::raw('COUNT(cf_users.symptom_id) as symptom_count'))
            ->groupBy('consultations.id', 'consultations.uuid', 'consultations.log_id', 'consultations.disease_id', 'consultations.created_at', 'consultations.updated_at', 'consultations.percentage')
            ->orderBy('percentage', 'desc')
            ->orderBy('symptom_count', 'desc');
    }
}
