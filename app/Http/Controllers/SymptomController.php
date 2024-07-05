<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('symptom.index', [
            'title' => 'Gejala Penyakit',
            'symptoms' => Symptom::all()
        ]);
        // dd(Symptom::where('disease_id', $disease->id)->get()->load('disease'));
        // dd($disease->load('symptoms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('symptom.form', [
            'title' => 'Tambah Data Gejala'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|max:255',
            'gejala' => 'required|max:255'
        ]);
        $validated['uuid'] = Str::uuid();

        Symptom::create($validated);

        $alert = [
            'alert' => 'Data berhasil ditambahkan',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('symptoms.index'))->with($alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Symptom $symptom)
    {
        return view('symptom.form', [
            'title' => 'Edit Data Gejala',
            'symptom' => $symptom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom)
    {
        $validated = $request->validate([
            'kode' => 'required|max:255',
            'gejala' => 'required|max:255'
        ]);

        $symptom->where('id', $symptom->id)->update($validated);

        $alert = [
            'alert' => 'Data berhasil diperbarui',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('symptoms.index'))->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();

        $alert = [
            'alert' => 'Data berhasil dihapus',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('symptoms.index'))->with($alert);
    }
}
