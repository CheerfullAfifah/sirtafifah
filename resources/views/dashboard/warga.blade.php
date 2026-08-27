@extends('layouts.app')

@section('title', 'Dashboard Warga')

@section('contents')
  <div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status Keanggotaan</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $warga->status_warga ?? '-' }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Tunggakan IPL</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($total_tunggakan, 0, ',', '.') }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pengajuan Surat</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $surat->count() }}</div>
        </div>
      </div>
    </div>
  </div>

  @if (!$warga)
    <div class="alert alert-warning">Profil warga Anda belum lengkap. Silakan hubungi pengurus RT.</div>
  @endif

  <div class="row">
    <div class="col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Tagihan IPL Terbaru</h6>
          <a href="{{ route('ipl.tagihan-saya') }}" class="small">Lihat semua</a>
        </div>
        <div class="card-body">
          @forelse ($tagihan->take(5) as $t)
            <div class="d-flex justify-content-between border-bottom py-2">
              <div>
                <strong>Periode {{ $t->periode }}</strong><br>
                <span class="small text-gray-500">Rp {{ number_format($t->nominal, 0, ',', '.') }} &middot; Jatuh tempo {{ \Carbon\Carbon::parse($t->jatuh_tempo)->format('d M Y') }}</span>
              </div>
              <span class="badge-wk badge-wk-{{ $t->status == 'Lunas' ? 'green' : ($t->status == 'Menunggu Verifikasi' ? 'yellow' : 'red') }} align-self-center">{{ $t->status }}</span>
            </div>
          @empty
            <p class="text-gray-500 mb-0">Belum ada tagihan.</p>
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">Status Pengajuan Surat</h6>
          <a href="{{ route('surat.create') }}" class="small">Ajukan baru</a>
        </div>
        <div class="card-body">
          @forelse ($surat->take(5) as $s)
            <div class="d-flex justify-content-between border-bottom py-2">
              <div>
                <strong>{{ $s->jenis_surat }}</strong><br>
                <span class="small text-gray-500">{{ \Carbon\Carbon::parse($s->tanggal_pengajuan)->format('d M Y') }}</span>
              </div>
              <span class="badge-wk badge-wk-pink align-self-center">{{ $s->status }}</span>
            </div>
          @empty
            <p class="text-gray-500 mb-0">Belum ada pengajuan surat.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
