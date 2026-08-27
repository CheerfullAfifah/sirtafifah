@extends('layouts.app')

@section('title', isset($suratUndangan) ? 'Edit Surat Undangan' : 'Buat Surat Undangan')

@section('contents')
<form action="{{ isset($suratUndangan) ? route('surat-undangan.update', $suratUndangan->id) : route('surat-undangan.save') }}" method="post">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ isset($suratUndangan) ? 'Form Edit Surat Undangan' : 'Form Surat Undangan' }}</h6>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Nomor</label>
          <input type="text" name="nomor" class="form-control" value="{{ old('nomor', $suratUndangan->nomor ?? '') }}">
        </div>
        <div class="form-group col-md-4">
          <label>Jenis Kegiatan</label>
          <select name="jenis_kegiatan" class="form-control">
            @foreach (['Kerja Bakti', 'Rapat RT', 'Kegiatan Warga', 'Lainnya'] as $jk)
              <option value="{{ $jk }}" {{ old('jenis_kegiatan', $suratUndangan->jenis_kegiatan ?? '') == $jk ? 'selected' : '' }}>{{ $jk }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Tanggal Acara</label>
          <input type="date" name="tanggal_acara" class="form-control" value="{{ old('tanggal_acara', $suratUndangan->tanggal_acara ?? '') }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Waktu</label>
          <input type="text" name="waktu" class="form-control" placeholder="mis. 07.00 WIB - selesai" value="{{ old('waktu', $suratUndangan->waktu ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Tempat</label>
          <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $suratUndangan->tempat ?? '') }}">
        </div>
      </div>
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ old('judul', $suratUndangan->judul ?? '') }}">
      </div>
      <div class="form-group">
        <label>Isi Undangan</label>
        <textarea name="isi" class="form-control" rows="5">{{ old('isi', $suratUndangan->isi ?? '') }}</textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('surat-undangan') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
