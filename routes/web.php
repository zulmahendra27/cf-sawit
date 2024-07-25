<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\KnowledgebaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'index'])->name('auth.loginview')->middleware(['guest']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login')->middleware(['guest']);
Route::get('/register', [AuthController::class, 'register'])->name('auth.registerview')->middleware(['guest']);
Route::post('/register', [AuthController::class, 'registering'])->name('auth.register')->middleware(['guest']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
// Route::get('/test', [AuthController::class, 'test']);

Route::middleware(['admin'])->group(function () {
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

    // route management users
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);

    // route delete consultation
    Route::delete('/consultation/{log}', [ConsultationController::class, 'delete'])->name('consultation.delete');
});

Route::middleware(['user'])->group(function () {
    // route konsultasi
    Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');
    Route::post('/consultation', [ConsultationController::class, 'diagnose'])->name('consultation.diagnose');
    Route::post('/consultation/findSymptoms', [ConsultationController::class, 'findSymptoms'])->name('consultation.findSymptoms');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class);
    Route::get('/consultation/result', [ConsultationController::class, 'result'])->name('consultation.result');
    Route::get('/consultation/result/{log}', [ConsultationController::class, 'detail'])->name('consultation.detail');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
});
