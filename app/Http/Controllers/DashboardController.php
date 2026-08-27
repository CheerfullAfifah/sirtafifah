<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;
use App\Models\Rumah;
use App\Models\Ipl;
use App\Models\Pembayaran;
use App\Models\Surat;
use App\Models\BeritaAcara;
use App\Models\SuratKeluar;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $data = [
                'jumlah_warga' => Warga::count(),
                'jumlah_rumah' => Rumah::count(),
                'tagihan_belum_bayar' => Ipl::where('status', 'Belum Bayar')->count(),
                'tagihan_menunggu_verifikasi' => Ipl::where('status', 'Menunggu Verifikasi')->count(),
                'pembayaran_menunggu_verifikasi' => Pembayaran::where('status', 'Menunggu Verifikasi')->count(),
                'surat_diajukan' => Surat::whereIn('status', ['Diajukan', 'Diproses'])->count(),
                'jumlah_berita_acara' => BeritaAcara::count(),
                'jumlah_surat_keluar' => SuratKeluar::count(),
                'surat_terbaru' => Surat::with('warga')->latest()->take(5)->get(),
                'pembayaran_terbaru' => Pembayaran::with(['warga', 'ipl'])->latest()->take(5)->get(),
            ];

            return view('dashboard.admin', $data);
        }

        $warga = Warga::where('user_id', $user->id)->first();

        $data = [
            'warga' => $warga,
            'tagihan' => $warga ? Ipl::where('warga_id', $warga->id)->latest()->get() : collect(),
            'surat' => $warga ? Surat::where('warga_id', $warga->id)->latest()->get() : collect(),
            'total_tunggakan' => $warga ? Ipl::where('warga_id', $warga->id)->where('status', '!=', 'Lunas')->sum('nominal') : 0,
        ];

        return view('dashboard.warga', $data);
    }
}
