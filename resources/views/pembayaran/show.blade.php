@extends('layouts.app')

@section('title', 'Detail Pembayaran')

@section('contents')
  <div class="row">
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Detail Pembayaran</h6></div>
        <div class="card-body">
          <table class="table table-borderless mb-0">
            <tr><th width="180">Warga</th><td>{{ $pembayaran->warga->nama ?? '-' }}</td></tr>
            <tr><th>Periode</th><td>{{ $pembayaran->ipl->periode ?? '-' }}</td></tr>
            <tr><th>Nominal</th><td>Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</td></tr>
            <tr><th>Metode</th><td>{{ $pembayaran->metode }}</td></tr>
            <tr><th>Tanggal Bayar</th><td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y') }}</td></tr>
            <tr><th>Status</th><td><span class="badge-wk badge-wk-{{ $pembayaran->status == 'Disetujui' ? 'green' : ($pembayaran->status == 'Menunggu Verifikasi' ? 'yellow' : 'red') }}">{{ $pembayaran->status }}</span></td></tr>
          </table>
          @if ($pembayaran->bukti_pembayaran)
            <hr>
            <p class="mb-2 font-weight-bold">Bukti Pembayaran:</p>
            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" class="img-fluid rounded border">
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Verifikasi</h6></div>
        <div class="card-body">
          @if ($pembayaran->status == 'Menunggu Verifikasi')
            <form action="{{ route('pembayaran.verifikasi', $pembayaran->id) }}" method="POST">
              @csrf
              <div class="form-group">
                <label>Catatan (opsional)</label>
                <textarea name="catatan" class="form-control" rows="3"></textarea>
              </div>
              <button type="submit" name="status" value="Disetujui" class="btn btn-primary">Setujui &amp; Tandai Lunas</button>
              <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Tolak</button>
            </form>
          @else
            <p class="text-gray-600">Pembayaran ini sudah diverifikasi dengan status <strong>{{ $pembayaran->status }}</strong>.</p>
            @if ($pembayaran->catatan)
              <p class="small text-gray-500">Catatan: {{ $pembayaran->catatan }}</p>
            @endif
          @endif
          <a href="{{ route('pembayaran') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
      </div>
    </div>
  </div>
@endsection
