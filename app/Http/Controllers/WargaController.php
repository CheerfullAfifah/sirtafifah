<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index()
    {
        $data = Warga::latest()->get();
        return view('warga.index', ['data' => $data]);
    }

    public function add()
    {
        return view('warga.form');
    }

    public function save(Request $request)
    {
        $request->validate([
            'nik' => 'required|digits_between:10,20|unique:wargas,nik',
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'status_warga' => 'required|in:Menunggu Verifikasi,Aktif,Nonaktif',
        ]);

        Warga::create($request->only([
            'nik', 'nama', 'email', 'no_hp', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'status_warga',
        ]));

        return redirect()->route('warga')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('warga.form', ['warga' => $warga]);
    }

    public function update($id, Request $request)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'nik' => 'required|digits_between:10,20|unique:wargas,nik,' . $warga->id,
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string',
            'status_warga' => 'required|in:Menunggu Verifikasi,Aktif,Nonaktif',
        ]);

        $warga->update($request->only([
            'nik', 'nama', 'email', 'no_hp', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'status_warga',
        ]));

        return redirect()->route('warga')->with('success', 'Data warga berhasil diperbarui.');
    }

    public function delete($id)
    {
        Warga::findOrFail($id)->delete();
        return redirect()->route('warga')->with('success', 'Data warga berhasil dihapus.');
    }
}
