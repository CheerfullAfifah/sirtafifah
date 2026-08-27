@extends('layouts.app')

@section('title', 'Ajukan Surat')

@section('contents')
<form action="{{ route('surat.store') }}" method="post">
  @csrf
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Surat</h6>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label>Jenis Surat</label>
        <select name="jenis_surat" class="form-control">
          <option value="Surat Kematian" {{ old('jenis_surat') == 'Surat Kematian' ? 'selected' : '' }}>Surat Kematian</option>
          <option value="Surat Domisili" {{ old('jenis_surat') == 'Surat Domisili' ? 'selected' : '' }}>Surat Domisili</option>
          <option value="Surat Pengantar" {{ old('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
          <option value="Lainnya" {{ old('jenis_surat') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
      </div>
      <div class="form-group">
        <label>Perihal</label>
        <input type="text" name="perihal" class="form-control" placeholder="mis. Untuk keperluan administrasi bank" value="{{ old('perihal') }}">
      </div>
      <div class="form-group">
        <label>Keterangan / Isi Pengajuan</label>
        <textarea name="keterangan" class="form-control" rows="5" placeholder="Jelaskan keperluan surat secara detail">{{ old('keterangan') }}</textarea>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
      <a href="{{ route('surat') }}" class="btn btn-secondary">Batal</a>
    </div>
  </div>
</form>
@endsection
