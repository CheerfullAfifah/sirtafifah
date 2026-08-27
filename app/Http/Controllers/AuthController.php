<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    // Public registration is always for Warga (Admin accounts are created via seeder/Kelola Pengguna).
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'nik' => 'required|digits_between:10,20|unique:wargas,nik',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'password' => 'required|confirmed|min:6',
        ])->validate();

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'Warga',
            ]);

            Warga::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'nama' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'status_warga' => 'Menunggu Verifikasi',
            ]);
        });

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login. Data Anda akan diverifikasi oleh pengurus RT.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
