<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', [
            'users' => User::where('level', '!=', 'admin')->orderBy('level', 'asc')->get(),
            'title' => 'Manajemen User'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.form', [
            'title' => 'Tambah Data User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username', 'min:5'],
            'password' => ['required', 'confirmed', 'min:5'],
            'level' => ['required']
        ]);

        // dd($validated);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        $alert = [
            'alert' => 'Data berhasil ditambahkan',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('users.index'))->with($alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.form', [
            'title' => 'Edit Data User',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        if (array_key_exists('password', $request->input())) {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'password' => 'min:5'
            ]);

            $validated['password'] = Hash::make($validated['password']);
        }

        $user->where('id', $user->id)->update($validated);

        $alert = [
            'alert' => 'Data berhasil diperbarui',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('users.index'))->with($alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        $alert = [
            'alert' => 'Data berhasil dihapus',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('users.index'))->with($alert);
    }
}
