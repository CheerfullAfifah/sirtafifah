@extends('layouts.app')

@section('title', 'Pengajuan Surat')

@section('contents')
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold text-primary">Pengajuan Surat</h6>
      @if (!auth()->user()->isAdmin())
        <a href="{{ route('surat.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Ajukan Surat</a>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              @if (auth()->user()->isAdmin())<th>Warga</th>@endif
              <th>Jenis Surat</th>
              <th>Tanggal Pengajuan</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($data as $row)
              <tr>
                <td>{{ $loop->iteration }}</td>
                @if (auth()->user()->isAdmin())<td>{{ $row->warga->nama ?? '-' }}</td>@endif
                <td>{{ $row->jenis_surat }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_pengajuan)->format('d M Y') }}</td>
                <td><span class="badge-wk badge-wk-pink">{{ $row->status }}</span></td>
                <td><a href="{{ route('surat.show', $row->id) }}" class="btn btn-primary btn-sm">Detail</a></td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center text-gray-500">Belum ada pengajuan surat.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
