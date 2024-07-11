<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Support\Str;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Models\Knowledgebase;

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
        $validated = $request->validate([
            'gejala' => 'required|array'
        ]);

        $diseases = Disease::with('knowledgebases')->get();
        $arraySymptoms = [];

        if ($diseases) {
            foreach ($diseases as $keyDisease => $disease) {
                $arraySymptoms[$keyDisease][0] = $disease->id;
                $arraySymptoms[$keyDisease][1] = $disease->nama;
                foreach ($disease->knowledgebases as $keyKnowledgebase => $knowledgebase) {
                    $arraySymptoms[$keyDisease][2][$keyKnowledgebase] = [$knowledgebase->symptom->id, $knowledgebase->cfpakar];
                }
            }
        }

        $arrayCfHE = [];

        if ($arraySymptoms) {
            foreach ($arraySymptoms as $keySymptom => $symptoms) {
                $i = 0;
                foreach ($symptoms[2] as $symptom) {
                    foreach ($validated['gejala'] as $data) {
                        $explode = explode('-_-', $data);
                        $idRequest = $explode[0];
                        $cfuser = $explode[1];
                        if ($symptom[0] == $idRequest) {
                            // $datas[$keySymptom][$i] =
                            //     $i++;
                            // print_r($symptom[0]);
                            // print_r($symptom[1]);

                            $arrayCfHE[$keySymptom][0] = $symptoms[0];
                            $arrayCfHE[$keySymptom][1] = $symptoms[1];
                            $arrayCfHE[$keySymptom][2][$i] = [$idRequest, ($symptom[1] * $cfuser)];
                            $i++;
                        }
                    }
                }
                // print_r($symptom);
            }
        }

        if ($arrayCfHE) {
            $arrayPercentage = [];
            foreach ($arrayCfHE as $keyCfHE => $cfHE) {
                // print_r(count($cfHE));
                $cfCombine = $cfHE[2][0][1];
                // $arrayCfCombine[] = $cfCombine;
                if (count($cfHE) > 1) {
                    for ($i = 1; $i < count($cfHE[2]); $i++) {
                        $cfCombine += $cfHE[2][$i][1] * (1 - $cfCombine);
                        // $arrayCfCombine[] = $cfCombine;
                        // print_r($cfCombine);
                    }
                }

                $arrayPercentage[$keyCfHE]['id'] = $cfHE[0];
                $arrayPercentage[$keyCfHE]['disease'] = $cfHE[1];
                $arrayPercentage[$keyCfHE]['percentage'] = round($cfCombine * 100, 2);

                // print_r($cfCombine * 100);
                // print_r($arrayCfCombine);
                // print_r('<br>');
            }
        }

        usort($arrayPercentage, function ($a, $b) {
            return $b['percentage'] <=> $a['percentage'];
        });

        foreach ($arrayPercentage as $percentage) {
            $uuid = Str::uuid();

            Consultation::create([
                'uuid' => $uuid,
                'user_id' => auth()->user()->id,
                'disease_id' => $percentage['id'],
                'percentage' => $percentage['percentage']
            ]);

            // $alert = [
            //     'alert' => 'Diagnosa berhasil',
            //     'title' => 'Sukses!',
            //     'type' => 'success'
            // ];

            return redirect(route('consultation.detail', $uuid));
        }

        // dd($arrayPercentage);
    }

    public function result()
    {
        $consultations = Consultation::with('disease')->where(['user_id' => auth()->user()->id])->latest()->take(10)->get();

        if (auth()->user()->level === 'admin') {
            $consultations = User::with(['consultations' => function ($query) {
                $query->latest()->limit(10);
            }])->where(['level' => 'user'])->get();
        }

        return view('consultation.result', [
            'title' => 'Riwayat Diagnosa',
            'consultations' => $consultations
        ]);
    }

    public function detail(Consultation $consultation)
    {
        return view('consultation.detail', [
            'title' => 'Hasil Diagnosa',
            'consultation' => $consultation->load('disease')
        ]);
    }

    public function findSymptoms(Request $request)
    {
        $validated = $request->validate([
            'data_value' => 'required'
        ]);

        $explode = explode('-_-', $validated['data_value']);
        $symptom_id = $explode[0];

        // Cari knowledgebase berdasarkan symptom_id
        $knowledgebases = Knowledgebase::with('disease', 'symptom')
            ->where('symptom_id', $symptom_id)
            ->get();

        if ($knowledgebases->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan untuk gejala ini.'], 404);
        }

        $response = [];

        // Loop untuk mengumpulkan semua symptom dari setiap disease
        foreach ($knowledgebases as $knowledgebase) {
            $disease = $knowledgebase->disease;

            $symptoms = Knowledgebase::with('symptom')
                ->where('disease_id', $disease->id)
                ->get()
                ->pluck('symptom');

            if ($symptoms) {
                foreach ($symptoms as $symptom) {
                    $response[$symptom->id] = [
                        'id' => $symptom->id,
                        'gejala' => $symptom->gejala,
                    ];
                }
            }
        }

        return response()->json(['symptoms' => $response]);
    }
}
