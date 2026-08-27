<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pembayaran;
use App\Models\Ipl;
use App\Models\Warga;

class PembayaranController extends Controller
{
    // Warga: form bayar untuk sebuah tagihan (menampilkan info DANA + QR Code)
    public function bayar($iplId)
    {
        $ipl = Ipl::with('rumah')->findOrFail($iplId);
        $warga = Warga::where('user_id', Auth::id())->firstOrFail();

        abort_unless($ipl->warga_id === $warga->id, 403);

        return view('pembayaran.bayar', compact('ipl', 'warga'));
    }

    public function bayarSave(Request $request, $iplId)
    {
        $ipl = Ipl::findOrFail($iplId);
        $warga = Warga::where('user_id', Auth::id())->firstOrFail();

        abort_unless($ipl->warga_id === $warga->id, 403);

        $request->validate([
            'metode' => 'required|string|max:50',
            'tanggal_bayar' => 'required|date',
            'bukti_pembayaran' => 'required|image|max:4096',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

        DB::transaction(function () use ($request, $ipl, $warga, $path) {
            Pembayaran::create([
                'ipl_id' => $ipl->id,
                'warga_id' => $warga->id,
                'nominal' => $ipl->nominal,
                'metode' => $request->metode,
                'bukti_pembayaran' => $path,
                'tanggal_bayar' => $request->tanggal_bayar,
                'status' => 'Menunggu Verifikasi',
            ]);

            $ipl->update(['status' => 'Menunggu Verifikasi']);
        });

        return redirect()->route('ipl.tagihan-saya')->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi pengurus RT.');
    }

    // Admin: daftar & verifikasi pembayaran
    public function index()
    {
        $data = Pembayaran::with(['warga', 'ipl'])->latest()->get();
        return view('pembayaran.index', ['data' => $data]);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['warga', 'ipl'])->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function verifikasi($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
            'catatan' => 'nullable|string',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        DB::transaction(function () use ($pembayaran, $request) {
            $pembayaran->update([
                'status' => $request->status,
                'catatan' => $request->catatan,
            ]);

            $pembayaran->ipl->update([
                'status' => $request->status === 'Disetujui' ? 'Lunas' : 'Belum Bayar',
            ]);
        });

        return redirect()->route('pembayaran')->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
