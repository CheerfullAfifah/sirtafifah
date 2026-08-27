@extends('layouts.app')

@section('title', 'Billing IPL')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Billing IPL</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('ipl.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Buat Tagihan</a>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Warga</th>
              <th>Rumah</th>
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
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->warga->nama ?? '-' }}</td>
                <td>{{ $row->rumah->nomor_rumah ?? '-' }}</td>
                <td>{{ $row->periode }}</td>
                <td>Rp {{ number_format($row->nominal, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->jatuh_tempo)->format('d M Y') }}</td>
                <td><span class="badge-wk badge-wk-{{ $row->status == 'Lunas' ? 'green' : ($row->status == 'Menunggu Verifikasi' ? 'yellow' : 'red') }}">{{ $row->status }}</span></td>
                <td>
                  <a href="{{ route('ipl.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <a href="{{ route('ipl.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus tagihan ini?')">Hapus</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="8" class="text-center text-gray-500">Belum ada tagihan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
