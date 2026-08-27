@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Verifikasi Pembayaran</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Warga</th>
              <th>Periode</th>
              <th>Nominal</th>
              <th>Tanggal Bayar</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->warga->nama ?? '-' }}</td>
                <td>{{ $row->ipl->periode ?? '-' }}</td>
                <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_bayar)->format('d M Y') }}</td>
                <td><span class="badge-wk badge-wk-{{ $row->status == 'Disetujui' ? 'green' : ($row->status == 'Menunggu Verifikasi' ? 'yellow' : 'red') }}">{{ $row->status }}</span></td>
                <td><a href="{{ route('pembayaran.show', $row->id) }}" class="btn btn-primary btn-sm">Detail</a></td>
              </tr>
            @empty
              <tr><td colspan="7" class="text-center text-gray-500">Belum ada pembayaran.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
