@extends('layouts.app')

@section('title', isset($beritaAcara) ? 'Edit Berita Acara' : 'Buat Berita Acara')

@section('contents')
<form action="{{ isset($beritaAcara) ? route('berita-acara.update', $beritaAcara->id) : route('berita-acara.save') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ isset($beritaAcara) ? 'Form Edit Berita Acara' : 'Form Berita Acara' }}</h6>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Nomor</label>
          <input type="text" name="nomor" class="form-control" value="{{ old('nomor', $beritaAcara->nomor ?? '') }}">
        </div>
        <div class="form-group col-md-4">
          <label>Tanggal</label>
          <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $beritaAcara->tanggal ?? '') }}">
        </div>
        <div class="form-group col-md-4">
          <label>Tempat</label>
          <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $beritaAcara->tempat ?? '') }}">
        </div>
      </div>
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $beritaAcara->judul ?? '') }}">
      </div>
      <div class="form-group">
        <label>Isi Berita Acara</label>
        <textarea name="isi" class="form-control" rows="5">{{ old('isi', $beritaAcara->isi ?? '') }}</textarea>
      </div>
      <div class="form-group">
        <label>Pihak Terkait</label>
        <textarea name="pihak_terkait" class="form-control" rows="2">{{ old('pihak_terkait', $beritaAcara->pihak_terkait ?? '') }}</textarea>
      </div>
      <div class="form-group">
        <label>Dokumentasi (foto, opsional)</label>
        <input type="file" name="dokumentasi" class="form-control-file" accept="image/*">
        @if (isset($beritaAcara) && $beritaAcara->dokumentasi)
          <img src="{{ asset('storage/' . $beritaAcara->dokumentasi) }}" class="img-fluid rounded border mt-2" style="max-width: 250px;">
        @endif
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('berita-acara') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
