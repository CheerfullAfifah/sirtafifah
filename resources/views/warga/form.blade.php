@extends('layouts.app')

@section('title', isset($warga) ? 'Edit Warga' : 'Tambah Warga')

@section('contents')
<form action="{{ isset($warga) ? route('warga.update', $warga->id) : route('warga.save') }}" method="post">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ isset($warga) ? 'Form Edit Warga' : 'Form Tambah Warga' }}</h6>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>NIK</label>
          <input type="text" class="form-control" name="nik" value="{{ old('nik', $warga->nik ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" value="{{ old('nama', $warga->nama ?? '') }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Email</label>
          <input type="email" class="form-control" name="email" value="{{ old('email', $warga->email ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>No. HP</label>
          <input type="text" class="form-control" name="no_hp" value="{{ old('no_hp', $warga->no_hp ?? '') }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Jenis Kelamin</label>
          <select name="jenis_kelamin" class="form-control">
            <option value="Laki-laki" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $warga->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label>Tanggal Lahir</label>
          <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir', $warga->tanggal_lahir ?? '') }}">
        </div>
        <div class="form-group col-md-4">
          <label>Status Warga</label>
          <select name="status_warga" class="form-control">
            @foreach (['Menunggu Verifikasi', 'Aktif', 'Nonaktif'] as $st)
              <option value="{{ $st }}" {{ old('status_warga', $warga->status_warga ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" name="alamat" rows="2">{{ old('alamat', $warga->alamat ?? '') }}</textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('warga') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
