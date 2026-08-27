@extends('layouts.app')

@section('title', isset($rumah) ? 'Edit Rumah' : 'Tambah Rumah')

@section('contents')
<form action="{{ isset($rumah) ? route('rumah.update', $rumah->id) : route('rumah.save') }}" method="post">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ isset($rumah) ? 'Form Edit Rumah' : 'Form Tambah Rumah' }}</h6>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Nomor Rumah</label>
          <input type="text" class="form-control" name="nomor_rumah" value="{{ old('nomor_rumah', $rumah->nomor_rumah ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Blok</label>
          <input type="text" class="form-control" name="blok" value="{{ old('blok', $rumah->blok ?? '') }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Nama Pemilik</label>
          <input type="text" class="form-control" name="nama_pemilik" value="{{ old('nama_pemilik', $rumah->nama_pemilik ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Nama Penghuni</label>
          <input type="text" class="form-control" name="nama_penghuni" value="{{ old('nama_penghuni', $rumah->nama_penghuni ?? '') }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Status Hunian</label>
          <select name="status_hunian" class="form-control">
            @foreach (['Milik Sendiri', 'Sewa/Kontrak', 'Kosong'] as $st)
              <option value="{{ $st }}" {{ old('status_hunian', $rumah->status_hunian ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Kaitkan dengan Warga (opsional)</label>
          <select name="warga_id" class="form-control">
            <option value="">-- Tidak dikaitkan --</option>
            @foreach ($warga as $w)
              <option value="{{ $w->id }}" {{ old('warga_id', $rumah->warga_id ?? '') == $w->id ? 'selected' : '' }}>{{ $w->nama }} ({{ $w->nik }})</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('rumah') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
