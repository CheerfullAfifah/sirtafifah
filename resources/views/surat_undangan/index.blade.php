@extends('layouts.app')

@section('title', 'Surat Undangan')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Surat Undangan</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('surat-undangan.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Buat Undangan</a>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th><th>Nomor</th><th>Jenis Kegiatan</th><th>Judul</th><th>Tanggal Acara</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nomor }}</td>
                <td><span class="badge-wk badge-wk-pink">{{ $row->jenis_kegiatan }}</span></td>
                <td>{{ $row->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_acara)->format('d M Y') }}</td>
                <td>
                  <a href="{{ route('surat-undangan.cetak', $row->id) }}" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                  <a href="{{ route('surat-undangan.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <a href="{{ route('surat-undangan.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus surat undangan ini?')">Hapus</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-gray-500">Belum ada surat undangan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
