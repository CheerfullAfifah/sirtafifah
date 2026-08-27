@extends('layouts.app')

@section('title', 'Pembayaran IPL')

@section('contents')
  <div class="row">
    <div class="col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Info Pembayaran</h6></div>
        <div class="card-body text-center">
          <p class="mb-1 text-gray-600">Periode <strong>{{ $ipl->periode }}</strong></p>
          <h3 class="font-weight-bold" style="color: var(--wk-pink-dark);">Rp {{ number_format($ipl->nominal, 0, ',', '.') }}</h3>
          <hr>
          @if (file_exists(public_path('images/qr-dana.png')))
            <img src="{{ asset('images/qr-dana.png') }}" alt="QR Code DANA" style="max-width: 220px;" class="mb-3">
          @else
            <div class="border rounded p-4 mb-3 text-gray-500" style="border-style: dashed !important;">
              <i class="fas fa-qrcode fa-4x mb-2"></i>
              <p class="mb-0 small">QR Code DANA belum diunggah.<br>Simpan gambar di <code>public/images/qr-dana.png</code>.</p>
            </div>
          @endif
          <p class="mb-0 small text-gray-600">Nomor DANA: <strong>0812-3456-7890 a.n. Pengurus RT 09</strong></p>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card shadow mb-4">
        <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Konfirmasi Pembayaran</h6></div>
        <div class="card-body">
          <form action="{{ route('pembayaran.bayar.save', $ipl->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Metode Pembayaran</label>
              <select name="metode" class="form-control">
                <option value="Transfer DANA">Transfer DANA</option>
                <option value="Tunai">Tunai ke Pengurus</option>
                <option value="Transfer Bank">Transfer Bank</option>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Bayar</label>
              <input type="date" name="tanggal_bayar" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            <div class="form-group">
              <label>Bukti Pembayaran (screenshot/foto)</label>
              <input type="file" name="bukti_pembayaran" class="form-control-file" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
            <a href="{{ route('ipl.tagihan-saya') }}" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
