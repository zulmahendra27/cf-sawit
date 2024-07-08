<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function index()
    {
        return view('consultation.index', [
            'title' => 'Konsultasi Penyakit',
            'symptoms' => Symptom::all()
        ]);
    }

    public function diagnose(Request $request)
    {
        $diseases = Disease::with('knowledgebases')->get();
        $arraySymptoms = [];

        if ($diseases) {
            foreach ($diseases as $keyDisease => $disease) {
                foreach ($disease->knowledgebases as $keyKnowledgebase => $knowledgebase) {
                    $arraySymptoms[$keyDisease][$keyKnowledgebase] = [$knowledgebase->symptom->kode, $knowledgebase->cfpakar];
                }
            }
        }

        $datas = [];
        $arrayCfHE = [];

        if ($arraySymptoms) {
            foreach ($arraySymptoms as $keySymptom => $symptoms) {
                $i = 0;
                foreach ($symptoms as $symptom) {
                    foreach ($request->gejala as $key => $data) {
                        $explode = explode('-_-', $data);
                        $kodeRequest = $explode[0];
                        $cfuser = $explode[1];
                        if ($symptom[0] == $kodeRequest) {
                            // $datas[$keySymptom][$i] =
                            //     $i++;
                            // print_r($symptom[0]);
                            // print_r($symptom[1]);

                            $arrayCfHE[$keySymptom][$i] = [$kodeRequest, ($symptom[1] * $cfuser)];
                            $i++;
                        }
                    }
                }
                // print_r($symptom);
            }
        }

        if ($arrayCfHE) {
            foreach ($arrayCfHE as $cfHE) {
                // print_r(count($cfHE));
                $cfCombine = 0;
                $cfHEOld = $cfHE[0][1];
                if (count($cfHE) > 1) {
                    for ($i = 1; $i < count($cfHE); $i++) {
                        $cfHEOld += $cfHE[$i][1] * (1 - $cfHEOld);
                    }
                }
                print_r($cfHEOld * 100);
                print_r('<br>');
            }
        }

        dd($arrayCfHE);
    }
}
