<?php

namespace App\Http\Controllers;

use App\Models\User;
use PDF;

class ReportController extends Controller
{
    function consultation(User $user)
    {
        // $consultations = User::with(['logs.highestConsultation.disease' => function ($query) {
        //     $query->latest();
        // }])->where(['username' => $user->username])->first();

        $consultations = User::with(['logs' => function ($query) {
            $query->latest();
        }, 'logs.highestConsultation.disease'])->where(['username' => $user->username])->first();

        $data = [
            'title' => 'Laporan Konsultasi',
            'consultations' => $consultations
        ];

        $pdf = PDF::loadview('pdf.consultation', $data);

        // return $pdf->download('laporan-konsultasi.pdf');
        return $pdf->stream('laporan-konsultasi.pdf');

        // dd($consultations);
    }
}
