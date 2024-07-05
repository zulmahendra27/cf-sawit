<?php

namespace App\Http\Controllers;

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
}
