@extends('layouts.app')

@section('title', 'Data Rumah')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Rumah</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('rumah.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Rumah</a>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>No. Rumah</th>
              <th>Blok</th>
              <th>Pemilik</th>
              <th>Penghuni</th>
              <th>Warga Terkait</th>
              <th>Status Hunian</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nomor_rumah }}</td>
                <td>{{ $row->blok ?? '-' }}</td>
                <td>{{ $row->nama_pemilik }}</td>
                <td>{{ $row->nama_penghuni ?? '-' }}</td>
                <td>{{ $row->warga->nama ?? '-' }}</td>
                <td><span class="badge-wk badge-wk-pink">{{ $row->status_hunian }}</span></td>
                <td>
                  <a href="{{ route('rumah.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <a href="{{ route('rumah.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data rumah ini?')">Hapus</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="8" class="text-center text-gray-500">Belum ada data rumah.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
