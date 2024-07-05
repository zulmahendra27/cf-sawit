<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use App\Models\Symptom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Knowledgebase;

class KnowledgebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('knowledgebase.index', [
            'title' => 'Basis Pengetahuan',
            'knowledgebases' => Knowledgebase::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('knowledgebase.form', [
            'title' => 'Tambah Basis Pengetahuan',
            'diseases' => Disease::all(),
            'symptoms' => Symptom::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'disease_id' => 'required|numeric',
            'symptom_id' => 'required|numeric',
            'cfpakar' => 'required|numeric'
        ]);
        $validated['uuid'] = Str::uuid();

        Knowledgebase::create($validated);

        $alert = [
            'alert' => 'Data berhasil ditambahkan',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('knowledgebases.index'))->with($alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(Knowledgebase $knowledgebase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Knowledgebase $knowledgebase)
    {
        return view('knowledgebase.form', [
            'title' => 'Edit Data Basis Pengetahuan',
            'knowledgebase' => $knowledgebase,
            'diseases' => Disease::all(),
            'symptoms' => Symptom::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Knowledgebase $knowledgebase)
    {
        $validated = $request->validate([
            'disease_id' => 'required|numeric',
            'symptom_id' => 'required|numeric',
            'cfpakar' => 'required|numeric'
        ]);
        $validated['uuid'] = Str::uuid();

        $knowledgebase->where('id', $knowledgebase->id)->update($validated);

        $alert = [
            'alert' => 'Data berhasil diperbarui',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('knowledgebases.index'))->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Knowledgebase $knowledgebase)
    {
        $knowledgebase->delete();

        $alert = [
            'alert' => 'Data berhasil dihapus',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('knowledgebases.index'))->with($alert);
    }
}
