<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratUndangan;

class SuratUndanganController extends Controller
{
    public function index()
    {
        $data = SuratUndangan::latest()->get();
        return view('surat_undangan.index', ['data' => $data]);
    }

    public function add()
    {
        return view('surat_undangan.form');
    }

    public function save(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|in:Kerja Bakti,Rapat RT,Kegiatan Warga,Lainnya',
            'judul' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'waktu' => 'nullable|string|max:50',
            'tempat' => 'nullable|string|max:255',
            'isi' => 'required|string',
        ]);

        SuratUndangan::create($request->only([
            'nomor', 'jenis_kegiatan', 'judul', 'tanggal_acara', 'waktu', 'tempat', 'isi',
        ]) + ['created_by' => Auth::id()]);

        return redirect()->route('surat-undangan')->with('success', 'Surat undangan berhasil dibuat.');
    }

    public function edit($id)
    {
        $suratUndangan = SuratUndangan::findOrFail($id);
        return view('surat_undangan.form', compact('suratUndangan'));
    }

    public function update($id, Request $request)
    {
        $suratUndangan = SuratUndangan::findOrFail($id);

        $request->validate([
            'nomor' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|in:Kerja Bakti,Rapat RT,Kegiatan Warga,Lainnya',
            'judul' => 'required|string|max:255',
            'tanggal_acara' => 'required|date',
            'waktu' => 'nullable|string|max:50',
            'tempat' => 'nullable|string|max:255',
            'isi' => 'required|string',
        ]);

        $suratUndangan->update($request->only([
            'nomor', 'jenis_kegiatan', 'judul', 'tanggal_acara', 'waktu', 'tempat', 'isi',
        ]));

        return redirect()->route('surat-undangan')->with('success', 'Surat undangan berhasil diperbarui.');
    }

    public function delete($id)
    {
        SuratUndangan::findOrFail($id)->delete();
        return redirect()->route('surat-undangan')->with('success', 'Surat undangan berhasil dihapus.');
    }

    public function cetak($id)
    {
        $suratUndangan = SuratUndangan::findOrFail($id);
        return view('surat_undangan.cetak', compact('suratUndangan'));
    }
}
