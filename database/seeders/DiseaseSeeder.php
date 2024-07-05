<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diseases = [
            'Akar (Blast Disease)',
            'Busuk Pangkal Batang (Basal Stem Rot/Ganoderma)',
            'Busuk Kuncup (Spear Rot)',
            'Garis Kuning (Patch Yellow)',
            'Tajuk (Crown Disease)',
            'Busuk Tandan'
        ];

        foreach ($diseases as $disease) {
            Disease::create([
                'uuid' => Str::uuid(),
                'nama' => $disease
            ]);
        }
    }
}
