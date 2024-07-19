<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('disease.index', [
            'diseases' => Disease::all(),
            'title' => 'Data Penyakit'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disease.form', [
            'title' => 'Tambah Data Penyakit'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'solusi' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $uuid = Str::uuid();

        // Menyimpan file dengan nama baru
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = $uuid . '.' . $extension;

        // Menyimpan file ke direktori 'images'
        $path = $file->storeAs('images', $filename, 'public');

        $validated['uuid'] = $uuid;
        $validated['image'] = $path;

        Disease::create($validated);

        $alert = [
            'alert' => 'Data berhasil ditambahkan',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('diseases.index'))->with($alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(Disease $disease)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disease $disease)
    {
        return view('disease.form', [
            'title' => 'Edit Data Penyakit',
            'disease' => $disease
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disease $disease)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'solusi' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mengambil data pengguna
        $path = $disease->image;

        // Jika ada file foto baru, simpan dengan nama baru
        if ($request->hasFile('image')) {
            // Hapus file lama
            if ($path && $path !== 'images/default.jpg' && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $disease->uuid . '.' . $extension;

            // Menyimpan file ke direktori 'images'
            $path = $file->storeAs('images', $filename, 'public');
        }

        $validated['image'] = $path;

        $disease->where('id', $disease->id)->update($validated);

        $alert = [
            'alert' => 'Data berhasil diperbarui',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('diseases.index'))->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disease $disease)
    {
        $path = $disease->image;

        // Menghapus file foto dari storage
        if ($path && $path !== 'images/default.jpg' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        $disease->delete();

        $alert = [
            'alert' => 'Data berhasil dihapus',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('diseases.index'))->with($alert);
    }
}
