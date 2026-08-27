<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BeritaAcara;

class BeritaAcaraController extends Controller
{
    public function index()
    {
        $data = BeritaAcara::latest()->get();
        return view('berita_acara.index', ['data' => $data]);
    }

    public function add()
    {
        return view('berita_acara.form');
    }

    public function save(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tempat' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'pihak_terkait' => 'nullable|string',
            'dokumentasi' => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['nomor', 'judul', 'tanggal', 'tempat', 'isi', 'pihak_terkait']);
        $data['created_by'] = Auth::id();

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')->store('berita-acara', 'public');
        }

        BeritaAcara::create($data);

        return redirect()->route('berita-acara')->with('success', 'Berita acara berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $beritaAcara = BeritaAcara::findOrFail($id);
        return view('berita_acara.form', compact('beritaAcara'));
    }

    public function update($id, Request $request)
    {
        $beritaAcara = BeritaAcara::findOrFail($id);

        $request->validate([
            'nomor' => 'required|string|max:100',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'tempat' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'pihak_terkait' => 'nullable|string',
            'dokumentasi' => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['nomor', 'judul', 'tanggal', 'tempat', 'isi', 'pihak_terkait']);

        if ($request->hasFile('dokumentasi')) {
            $data['dokumentasi'] = $request->file('dokumentasi')->store('berita-acara', 'public');
        }

        $beritaAcara->update($data);

        return redirect()->route('berita-acara')->with('success', 'Berita acara berhasil diperbarui.');
    }

    public function delete($id)
    {
        BeritaAcara::findOrFail($id)->delete();
        return redirect()->route('berita-acara')->with('success', 'Berita acara berhasil dihapus.');
    }
}
