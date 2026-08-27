<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Surat;
use App\Models\Warga;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    // Warga: ajukan surat baru
    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|in:Surat Kematian,Surat Domisili,Surat Pengantar,Lainnya',
            'perihal' => 'nullable|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $warga = Warga::where('user_id', Auth::id())->firstOrFail();

        Surat::create([
            'warga_id' => $warga->id,
            'jenis_surat' => $request->jenis_surat,
            'perihal' => $request->perihal,
            'keterangan' => $request->keterangan,
            'status' => 'Diajukan',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()->route('surat')->with('success', 'Pengajuan surat berhasil dikirim.');
    }

    // Daftar surat: admin lihat semua, warga lihat milik sendiri
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $data = Surat::with('warga')->latest()->get();
        } else {
            $warga = Warga::where('user_id', $user->id)->first();
            $data = $warga ? Surat::where('warga_id', $warga->id)->latest()->get() : collect();
        }

        return view('surat.index', ['data' => $data]);
    }

    public function show($id)
    {
        $surat = Surat::with('warga')->findOrFail($id);

        $user = Auth::user();
        if (!$user->isAdmin()) {
            $warga = Warga::where('user_id', $user->id)->first();
            abort_unless($warga && $surat->warga_id === $warga->id, 403);
        }

        return view('surat.show', compact('surat'));
    }

    // Admin: proses pengajuan surat
    public function proses($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:Diproses,Disetujui,Ditolak,Selesai',
            'catatan_admin' => 'nullable|string',
            'nomor_surat' => 'nullable|string|max:100',
        ]);

        $surat = Surat::findOrFail($id);

        $surat->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
            'nomor_surat' => $request->nomor_surat ?: $surat->nomor_surat,
        ]);

        return redirect()->route('surat.show', $surat->id)->with('success', 'Status pengajuan surat berhasil diperbarui.');
    }

    // Generate PDF surat (tersedia setelah disetujui/selesai)
    public function pdf($id)
    {
        $surat = Surat::with('warga')->findOrFail($id);

        $user = Auth::user();
        if (!$user->isAdmin()) {
            $warga = Warga::where('user_id', $user->id)->first();
            abort_unless($warga && $surat->warga_id === $warga->id, 403);
        }

        abort_unless(in_array($surat->status, ['Disetujui', 'Selesai']), 403, 'Surat belum disetujui.');

        $pdf = Pdf::loadView('surat.pdf', compact('surat'))->setPaper('a4');

        return $pdf->download('surat-' . $surat->jenis_surat . '-' . $surat->id . '.pdf');
    }
}
