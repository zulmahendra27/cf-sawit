<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'title' => 'Update Profil',
            'user' => User::findOrFail(auth()->user()->id)
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);

        if ($request->password !== null) {
            $validated = $request->validate([
                'name' => 'required|max:255',
                'password' => ['confirmed', 'min:5']
            ]);

            $validated['password'] = Hash::make($validated['password']);
        }

        $user->where('id', $user->id)->update($validated);

        $alert = [
            'alert' => 'Data berhasil diperbarui',
            'title' => 'Sukses!',
            'type' => 'success'
        ];

        return redirect(route('profile.index'))->with($alert);
    }
}
