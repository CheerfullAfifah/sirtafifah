<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #222; line-height: 1.6; }
    .header { text-align: center; border-bottom: 3px solid #d6336c; padding-bottom: 10px; margin-bottom: 20px; }
    .header h2 { margin: 0; color: #d6336c; }
    .header p { margin: 2px 0; font-size: 11px; }
    table.info { width: 100%; margin-bottom: 15px; }
    table.info td { padding: 3px 0; vertical-align: top; }
    .isi { text-align: justify; margin: 20px 0; }
    .ttd { margin-top: 60px; width: 250px; float: right; text-align: center; }
  </style>
</head>
<body>
  <div class="header">
    <h2>SURAT {{ strtoupper($surat->jenis_surat) }}</h2>
    <p>RT 09 / RW 10 &mdash; Citra Indah City, Bukit Angsana</p>
    <p>Nomor: {{ $surat->nomor_surat ?? '-' }}</p>
  </div>

  <p>Yang bertanda tangan di bawah ini, Ketua RT 09 / RW 10 Citra Indah City, Bukit Angsana, menerangkan bahwa:</p>

  <table class="info">
    <tr><td width="160">Nama</td><td>: {{ $surat->warga->nama ?? '-' }}</td></tr>
    <tr><td>NIK</td><td>: {{ $surat->warga->nik ?? '-' }}</td></tr>
    <tr><td>Jenis Kelamin</td><td>: {{ $surat->warga->jenis_kelamin ?? '-' }}</td></tr>
    <tr><td>Alamat</td><td>: {{ $surat->warga->alamat ?? '-' }}</td></tr>
  </table>

  <div class="isi">
    <p><strong>Perihal:</strong> {{ $surat->perihal ?? $surat->jenis_surat }}</p>
    <p>{{ $surat->keterangan }}</p>
    <p>Demikian surat ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
  </div>

  <div class="ttd">
    <p>Citra Indah City, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    <p>Ketua RT 09 / RW 10</p>
    <br><br><br>
    <p>(_____________________)</p>
  </div>
</body>
</html>
