<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'web_name' => 'Sistem Informasi Pemetaan',
            'title' => 'Login Form'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        $alert = [
            'alert' => 'Login gagal, periksa kembali username atau password',
            'title' => 'Error!',
            'type' => 'error',
            'btn' => 'danger'
        ];

        return back()->with($alert);
    }

    public function register()
    {
        return view('auth.register', [
            'web_name' => 'Sistem Informasi Pemetaan',
            'title' => 'Register Form'
        ]);
    }

    public function registering(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'username' => ['required', 'unique:users,username', 'min:5'],
            'password' => ['required', 'confirmed', 'min:5']
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        User::create($credentials);

        $alert = [
            'alert' => 'Registrasi berhasil',
            'title' => 'Sukses!',
            'type' => 'success',
            'btn' => 'success'
        ];

        return redirect(route('auth.loginview'))->with($alert);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('auth.loginview'));
    }

    // public function test()
    // {
    //     User::create([
    //         'name' => 'Administrator',
    //         'username' => 'admin',
    //         'password' => Hash::make('admin'),
    //         'level' => 'admin'
    //     ]);
    // }
}
