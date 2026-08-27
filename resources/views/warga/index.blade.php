@extends('layouts.app')

@section('title', 'Data Warga')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('warga.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Warga</a>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>No. HP</th>
              <th>Jenis Kelamin</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nik }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->no_hp ?? '-' }}</td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>
                  <span class="badge-wk badge-wk-{{ $row->status_warga == 'Aktif' ? 'green' : ($row->status_warga == 'Menunggu Verifikasi' ? 'yellow' : 'gray') }}">{{ $row->status_warga }}</span>
                </td>
                <td>
                  <a href="{{ route('warga.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <a href="{{ route('warga.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data warga ini?')">Hapus</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="7" class="text-center text-gray-500">Belum ada data warga.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
