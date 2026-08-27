@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat')

@section('contents')
  <div class="row">
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Detail Pengajuan</h6></div>
        <div class="card-body">
          <table class="table table-borderless mb-0">
            <tr><th width="180">Pemohon</th><td>{{ $surat->warga->nama ?? '-' }}</td></tr>
            <tr><th>Jenis Surat</th><td>{{ $surat->jenis_surat }}</td></tr>
            <tr><th>Perihal</th><td>{{ $surat->perihal ?? '-' }}</td></tr>
            <tr><th>Keterangan</th><td>{{ $surat->keterangan }}</td></tr>
            <tr><th>Tanggal Pengajuan</th><td>{{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->format('d M Y') }}</td></tr>
            <tr><th>Nomor Surat</th><td>{{ $surat->nomor_surat ?? '-' }}</td></tr>
            <tr><th>Status</th><td><span class="badge-wk badge-wk-pink">{{ $surat->status }}</span></td></tr>
            @if ($surat->catatan_admin)
              <tr><th>Catatan Admin</th><td>{{ $surat->catatan_admin }}</td></tr>
            @endif
          </table>

          @if (in_array($surat->status, ['Disetujui', 'Selesai']))
            <a href="{{ route('surat.pdf', $surat->id) }}" class="btn btn-primary mt-3"><i class="fas fa-file-pdf"></i> Unduh Surat (PDF)</a>
          @endif
        </div>
      </div>
    </div>

    @if (auth()->user()->isAdmin())
    <div class="col-lg-6">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Proses Pengajuan</h6></div>
        <div class="card-body">
          <form action="{{ route('surat.proses', $surat->id) }}" method="POST">
            @csrf
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                @foreach (['Diproses', 'Disetujui', 'Ditolak', 'Selesai'] as $st)
                  <option value="{{ $st }}" {{ $surat->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Nomor Surat (diisi saat disetujui)</label>
              <input type="text" name="nomor_surat" class="form-control" value="{{ $surat->nomor_surat }}" placeholder="mis. 012/RT09-RW10/VIII/2026">
            </div>
            <div class="form-group">
              <label>Catatan Admin</label>
              <textarea name="catatan_admin" class="form-control" rows="3">{{ $surat->catatan_admin }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
    @endif
  </div>
  <a href="{{ route('surat') }}" class="btn btn-secondary">Kembali</a>
@endsection
