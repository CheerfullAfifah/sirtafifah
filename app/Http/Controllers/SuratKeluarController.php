<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuratKeluar;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data = SuratKeluar::latest()->get();
        return view('surat_keluar.index', ['data' => $data]);
    }

    public function add()
    {
        return view('surat_keluar.form');
    }

    public function save(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'nullable|file|max:8192',
        ]);

        $data = $request->only(['nomor_surat', 'tanggal', 'tujuan', 'perihal', 'isi']);
        $data['created_by'] = Auth::id();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('surat-keluar', 'public');
        }

        SuratKeluar::create($data);

        return redirect()->route('surat-keluar')->with('success', 'Surat keluar berhasil dicatat.');
    }

    public function edit($id)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);
        return view('surat_keluar.form', compact('suratKeluar'));
    }

    public function update($id, Request $request)
    {
        $suratKeluar = SuratKeluar::findOrFail($id);

        $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'file' => 'nullable|file|max:8192',
        ]);

        $data = $request->only(['nomor_surat', 'tanggal', 'tujuan', 'perihal', 'isi']);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('surat-keluar', 'public');
        }

        $suratKeluar->update($data);

        return redirect()->route('surat-keluar')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function delete($id)
    {
        SuratKeluar::findOrFail($id)->delete();
        return redirect()->route('surat-keluar')->with('success', 'Surat keluar berhasil dihapus.');
    }
}
