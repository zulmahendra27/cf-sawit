<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\KnowledgebaseController;
use App\Http\Controllers\SymptomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main', [
        'title' => 'Dashboard'
    ]);
});

// route penyakit
Route::resource('diseases', DiseaseController::class)->except(['show']);

// route gejala
Route::resource('symptoms', SymptomController::class)->except(['show']);
// Route::get('/symptoms/{disease}', [SymptomController::class, 'index'])->name('symptoms.index');
// Route::get('/symptoms/{disease}/create', [SymptomController::class, 'create'])->name('symptoms.create');
// Route::post('/symptoms/{disease}', [SymptomController::class, 'store'])->name('symptoms.store');
// Route::get('/symptoms/{symptom}/edit', [SymptomController::class, 'edit'])->name('symptoms.edit');
// Route::put('/symptoms/{symptom}', [SymptomController::class, 'update'])->name('symptoms.update');
// Route::delete('/symptoms/{symptom}', [SymptomController::class, 'destroy'])->name('symptoms.destroy');

// route basis pengetahuan
Route::resource('knowledgebases', KnowledgebaseController::class)->except(['show']);

// route konsultasi
Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
Route::post('/consultation', [ConsultationController::class, 'diagnose'])->name('consultation.diagnose');
