<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\Warga;

class RumahController extends Controller
{
    public function index()
    {
        $data = Rumah::with('warga')->latest()->get();
        return view('rumah.index', ['data' => $data]);
    }

    public function add()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('rumah.form', ['warga' => $warga]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nomor_rumah' => 'required|string|max:50',
            'blok' => 'nullable|string|max:50',
            'nama_pemilik' => 'required|string|max:255',
            'nama_penghuni' => 'nullable|string|max:255',
            'status_hunian' => 'required|in:Milik Sendiri,Sewa/Kontrak,Kosong',
            'warga_id' => 'nullable|exists:wargas,id',
        ]);

        Rumah::create($request->only([
            'nomor_rumah', 'blok', 'nama_pemilik', 'nama_penghuni', 'status_hunian', 'warga_id',
        ]));

        return redirect()->route('rumah')->with('success', 'Data rumah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rumah = Rumah::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        return view('rumah.form', ['rumah' => $rumah, 'warga' => $warga]);
    }

    public function update($id, Request $request)
    {
        $rumah = Rumah::findOrFail($id);

        $request->validate([
            'nomor_rumah' => 'required|string|max:50',
            'blok' => 'nullable|string|max:50',
            'nama_pemilik' => 'required|string|max:255',
            'nama_penghuni' => 'nullable|string|max:255',
            'status_hunian' => 'required|in:Milik Sendiri,Sewa/Kontrak,Kosong',
            'warga_id' => 'nullable|exists:wargas,id',
        ]);

        $rumah->update($request->only([
            'nomor_rumah', 'blok', 'nama_pemilik', 'nama_penghuni', 'status_hunian', 'warga_id',
        ]));

        return redirect()->route('rumah')->with('success', 'Data rumah berhasil diperbarui.');
    }

    public function delete($id)
    {
        Rumah::findOrFail($id)->delete();
        return redirect()->route('rumah')->with('success', 'Data rumah berhasil dihapus.');
    }
}
