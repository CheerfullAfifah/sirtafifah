@extends('layouts.app')

@section('title', 'Berita Acara')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Berita Acara</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('berita-acara.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Buat Berita Acara</a>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th><th>Nomor</th><th>Judul</th><th>Tanggal</th><th>Tempat</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nomor }}</td>
                <td>{{ $row->judul }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                <td>{{ $row->tempat ?? '-' }}</td>
                <td>
                  <a href="{{ route('berita-acara.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <a href="{{ route('berita-acara.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus berita acara ini?')">Hapus</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-gray-500">Belum ada berita acara.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
