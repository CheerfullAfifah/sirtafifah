@extends('layouts.app')

@section('title', 'Surat Keluar')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
    </div>
    <div class="card-body">
      <a href="{{ route('surat-keluar.add') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Catat Surat Keluar</a>
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th><th>Nomor Surat</th><th>Tanggal</th><th>Tujuan</th><th>Perihal</th><th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nomor_surat }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                <td>{{ $row->tujuan }}</td>
                <td>{{ $row->perihal }}</td>
                <td>
                  @if ($row->file)
                    <a href="{{ asset('storage/' . $row->file) }}" class="btn btn-primary btn-sm" target="_blank">File</a>
                  @endif
                  <a href="{{ route('surat-keluar.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                  <a href="{{ route('surat-keluar.delete', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Hapus surat keluar ini?')">Hapus</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-gray-500">Belum ada surat keluar.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
