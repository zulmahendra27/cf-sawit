<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Knowledgebase;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KnowledgebaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cfpakar = [1, 0.4, 1, 0.4, 0.4, 1, 0.2, 1, 1, 1, 1, 1, 1, 1, 0.4, 0.6, 0.8, 0.6, 1, 0.6, 0.2, 1, 0.6, 0.2, 0.8, 1, 1, 0.2, 1, 0.2, 1, 1];

        $k = 0;
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 32; $j++) {
                if ($i == 1 && $j >= 1 && $j <= 5) {
                    Knowledgebase::create([
                        'disease_id' => $i,
                        'symptom_id' => $j,
                        'cfpakar' => $cfpakar[$k],
                        'uuid' => Str::uuid()
                    ]);
                    $k++;
                } elseif ($i == 2 && $j >= 6 && $j <= 12) {
                    $symptom_id = $j - 1;

                    if ($j == 6) {
                        $symptom_id = 3;
                        // continue;
                        // $k--;
                    }
                    Knowledgebase::create([
                        'disease_id' => $i,
                        'symptom_id' => $symptom_id,
                        'cfpakar' => $cfpakar[$k],
                        'uuid' => Str::uuid()
                    ]);
                    $k++;
                } elseif ($i == 3 && $j >= 13 && $j <= 15) {
                    Knowledgebase::create([
                        'disease_id' => $i,
                        'symptom_id' => $j - 1,
                        'cfpakar' => $cfpakar[$k],
                        'uuid' => Str::uuid()
                    ]);
                    $k++;
                } elseif ($i == 4 && $j >= 16 && $j <= 22) {
                    Knowledgebase::create([
                        'disease_id' => $i,
                        'symptom_id' => $j - 1,
                        'cfpakar' => $cfpakar[$k],
                        'uuid' => Str::uuid()
                    ]);
                    $k++;
                } elseif ($i == 5 && $j >= 23 && $j <= 26) {
                    Knowledgebase::create([
                        'disease_id' => $i,
                        'symptom_id' => $j - 1,
                        'cfpakar' => $cfpakar[$k],
                        'uuid' => Str::uuid()
                    ]);
                    $k++;
                } elseif ($i == 6 && $j >= 27 && $j <= 32) {
                    Knowledgebase::create([
                        'disease_id' => $i,
                        'symptom_id' => $j - 1,
                        'cfpakar' => $cfpakar[$k],
                        'uuid' => Str::uuid()
                    ]);
                    $k++;
                }
            }

            // if ($i == 1) {
            //     for ($j = 1; $j <= 5; $j++) {
            //         Knowledgebase::create([
            //             'disease_id' => $i,
            //             'symptom_id' => $j,
            //             'cfpakar'
            //         ]);
            //     }
            // } else {
            //     # code...
            // }
        }
    }
}
