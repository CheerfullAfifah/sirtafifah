<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ipl;
use App\Models\Warga;
use App\Models\Rumah;

class IplController extends Controller
{
    // Admin: kelola semua billing IPL
    public function index()
    {
        $data = Ipl::with(['warga', 'rumah'])->latest()->get();
        return view('ipl.index', ['data' => $data]);
    }

    public function add()
    {
        $warga = Warga::orderBy('nama')->get();
        $rumah = Rumah::orderBy('nomor_rumah')->get();
        return view('ipl.form', compact('warga', 'rumah'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'rumah_id' => 'nullable|exists:rumahs,id',
            'periode' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:0',
            'tanggal_tagihan' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Belum Bayar,Menunggu Verifikasi,Lunas',
            'keterangan' => 'nullable|string',
        ]);

        Ipl::create($request->only([
            'warga_id', 'rumah_id', 'periode', 'nominal', 'tanggal_tagihan', 'jatuh_tempo', 'status', 'keterangan',
        ]));

        return redirect()->route('ipl')->with('success', 'Tagihan IPL berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ipl = Ipl::findOrFail($id);
        $warga = Warga::orderBy('nama')->get();
        $rumah = Rumah::orderBy('nomor_rumah')->get();
        return view('ipl.form', compact('ipl', 'warga', 'rumah'));
    }

    public function update($id, Request $request)
    {
        $ipl = Ipl::findOrFail($id);

        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'rumah_id' => 'nullable|exists:rumahs,id',
            'periode' => 'required|string|max:20',
            'nominal' => 'required|numeric|min:0',
            'tanggal_tagihan' => 'required|date',
            'jatuh_tempo' => 'required|date',
            'status' => 'required|in:Belum Bayar,Menunggu Verifikasi,Lunas',
            'keterangan' => 'nullable|string',
        ]);

        $ipl->update($request->only([
            'warga_id', 'rumah_id', 'periode', 'nominal', 'tanggal_tagihan', 'jatuh_tempo', 'status', 'keterangan',
        ]));

        return redirect()->route('ipl')->with('success', 'Tagihan IPL berhasil diperbarui.');
    }

    public function delete($id)
    {
        Ipl::findOrFail($id)->delete();
        return redirect()->route('ipl')->with('success', 'Tagihan IPL berhasil dihapus.');
    }

    // Warga: lihat tagihan milik sendiri
    public function tagihanSaya()
    {
        $warga = Warga::where('user_id', Auth::id())->first();
        $data = $warga ? Ipl::with('rumah')->where('warga_id', $warga->id)->latest()->get() : collect();
        return view('ipl.tagihan_saya', ['data' => $data, 'warga' => $warga]);
    }
}
