@extends('layouts.app')

@section('title', isset($ipl) ? 'Edit Tagihan IPL' : 'Buat Tagihan IPL')

@section('contents')
<form action="{{ isset($ipl) ? route('ipl.update', $ipl->id) : route('ipl.save') }}" method="post">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">{{ isset($ipl) ? 'Form Edit Tagihan' : 'Form Buat Tagihan' }}</h6>
    </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Warga</label>
          <select name="warga_id" class="form-control">
            <option value="">-- Pilih Warga --</option>
            @foreach ($warga as $w)
              <option value="{{ $w->id }}" {{ old('warga_id', $ipl->warga_id ?? '') == $w->id ? 'selected' : '' }}>{{ $w->nama }} ({{ $w->nik }})</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Rumah (opsional)</label>
          <select name="rumah_id" class="form-control">
            <option value="">-- Tidak dikaitkan --</option>
            @foreach ($rumah as $r)
              <option value="{{ $r->id }}" {{ old('rumah_id', $ipl->rumah_id ?? '') == $r->id ? 'selected' : '' }}>{{ $r->nomor_rumah }} {{ $r->blok }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label>Periode (mis. Agustus 2026)</label>
          <input type="text" class="form-control" name="periode" value="{{ old('periode', $ipl->periode ?? '') }}">
        </div>
        <div class="form-group col-md-4">
          <label>Nominal (Rp)</label>
          <input type="number" step="0.01" class="form-control" name="nominal" value="{{ old('nominal', $ipl->nominal ?? '') }}">
        </div>
        <div class="form-group col-md-4">
          <label>Status</label>
          <select name="status" class="form-control">
            @foreach (['Belum Bayar', 'Menunggu Verifikasi', 'Lunas'] as $st)
              <option value="{{ $st }}" {{ old('status', $ipl->status ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label>Tanggal Tagihan</label>
          <input type="date" class="form-control" name="tanggal_tagihan" value="{{ old('tanggal_tagihan', $ipl->tanggal_tagihan ?? '') }}">
        </div>
        <div class="form-group col-md-6">
          <label>Jatuh Tempo</label>
          <input type="date" class="form-control" name="jatuh_tempo" value="{{ old('jatuh_tempo', $ipl->jatuh_tempo ?? '') }}">
        </div>
      </div>
      <div class="form-group">
        <label>Keterangan</label>
        <textarea class="form-control" name="keterangan" rows="2">{{ old('keterangan', $ipl->keterangan ?? '') }}</textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('ipl') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
