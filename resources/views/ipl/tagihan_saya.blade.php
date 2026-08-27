@extends('layouts.app')

@section('title', 'Tagihan IPL Saya')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tagihan IPL Saya</h6>
    </div>
    <div class="card-body">
      @if (!$warga)
        <div class="alert alert-warning">Profil warga Anda belum lengkap. Silakan hubungi pengurus RT.</div>
      @else
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Periode</th>
                <th>Nominal</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($data as $row)
                <tr>
                  <td>{{ $row->periode }}</td>
                  <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                  <td>{{ \Carbon\Carbon::parse($row->jatuh_tempo)->format('d M Y') }}</td>
                  <td><span class="badge-wk badge-wk-{{ $row->status == 'Lunas' ? 'green' : ($row->status == 'Menunggu Verifikasi' ? 'yellow' : 'red') }}">{{ $row->status }}</span></td>
                  <td>
                    @if ($row->status == 'Belum Bayar')
                      <a href="{{ route('pembayaran.bayar', $row->id) }}" class="btn btn-primary btn-sm">Bayar Sekarang</a>
                    @else
                      <span class="text-gray-500 small">-</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr><td colspan="5" class="text-center text-gray-500">Belum ada tagihan.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>
@endsection
