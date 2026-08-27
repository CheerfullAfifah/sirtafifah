@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('contents')
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Warga</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_warga }}</div>
            </div>
            <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Rumah</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_rumah }}</div>
            </div>
            <div class="col-auto"><i class="fas fa-house-user fa-2x text-gray-300"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tagihan Belum Bayar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tagihan_belum_bayar }}</div>
            </div>
            <div class="col-auto"><i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pembayaran Menunggu Verifikasi</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pembayaran_menunggu_verifikasi }}</div>
            </div>
            <div class="col-auto"><i class="fas fa-money-check-alt fa-2x text-gray-300"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pengajuan Surat Aktif</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $surat_diajukan }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Berita Acara</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_berita_acara }}</div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Surat Keluar</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_surat_keluar }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Pengajuan Surat Terbaru</h6></div>
        <div class="card-body">
          @forelse ($surat_terbaru as $s)
            <div class="d-flex justify-content-between border-bottom py-2">
              <div>
                <strong>{{ $s->jenis_surat }}</strong><br>
                <span class="small text-gray-500">{{ $s->warga->nama ?? '-' }}</span>
              </div>
              <span class="badge-wk badge-wk-pink align-self-center">{{ $s->status }}</span>
            </div>
          @empty
            <p class="text-gray-500 mb-0">Belum ada pengajuan surat.</p>
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Pembayaran Terbaru</h6></div>
        <div class="card-body">
          @forelse ($pembayaran_terbaru as $p)
            <div class="d-flex justify-content-between border-bottom py-2">
              <div>
                <strong>{{ $p->warga->nama ?? '-' }}</strong><br>
                <span class="small text-gray-500">Periode {{ $p->ipl->periode ?? '-' }} &middot; Rp {{ number_format($p->nominal, 0, ',', '.') }}</span>
              </div>
              <span class="badge-wk badge-wk-pink align-self-center">{{ $p->status }}</span>
            </div>
          @empty
            <p class="text-gray-500 mb-0">Belum ada pembayaran.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
