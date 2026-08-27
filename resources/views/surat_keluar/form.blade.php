@extends('layouts.app')

@section('title', isset($suratKeluar) ? 'Edit Surat Keluar' : 'Catat Surat Keluar')

@section('contents')
<form action="{{ isset($suratKeluar) ? route('surat-keluar.update', $suratKeluar->id) : route('surat-keluar.save') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ isset($suratKeluar) ? 'Form Edit Surat Keluar' : 'Form Surat Keluar' }}</h6>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Nomor Surat</label>
          <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $suratKeluar->nomor_surat ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Tanggal</label>
          <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $suratKeluar->tanggal ?? '') }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Tujuan</label>
          <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $suratKeluar->tujuan ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Perihal</label>
          <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $suratKeluar->perihal ?? '') }}">
        </div>
      </div>
      <div class="form-group">
        <label>Isi Surat</label>
        <textarea name="isi" class="form-control" rows="5">{{ old('isi', $suratKeluar->isi ?? '') }}</textarea>
      </div>
      <div class="form-group">
        <label>Lampiran File (opsional)</label>
        <input type="file" name="file" class="form-control-file">
        @if (isset($suratKeluar) && $suratKeluar->file)
          <p class="small mt-2"><a href="{{ asset('storage/' . $suratKeluar->file) }}" target="_blank">Lihat file saat ini</a></p>
        @endif
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('surat-keluar') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
