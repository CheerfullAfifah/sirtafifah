<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cetak Surat Undangan</title>
  <style>
    body { font-family: 'Georgia', serif; font-size: 14px; color: #222; max-width: 700px; margin: 40px auto; line-height: 1.7; }
    .header { text-align: center; border-bottom: 3px solid #d6336c; padding-bottom: 12px; margin-bottom: 20px; }
    .header h2 { margin: 0; color: #d6336c; }
    table.info td { padding: 3px 0; vertical-align: top; }
    .print-btn { text-align: center; margin-bottom: 20px; }
    .print-btn button { background: linear-gradient(90deg,#d6336c,#ff6fa5); color: #fff; border: none; padding: 8px 20px; border-radius: 20px; cursor: pointer; }
    @media print { .print-btn { display: none; } }
  </style>
</head>
<body>
  <div class="print-btn"><button onclick="window.print()">Cetak Surat Undangan</button></div>
  <div class="header">
    <h2>SURAT UNDANGAN</h2>
    <p>RT 09 / RW 10 &mdash; Citra Indah City, Bukit Angsana</p>
    <p>Nomor: {{ $suratUndangan->nomor }}</p>
  </div>

  <p>Kepada Yth.<br>Seluruh Warga RT 09 / RW 10<br>di tempat</p>

  <p>Dengan hormat, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dalam kegiatan:</p>

  <table class="info">
    <tr><td width="140">Kegiatan</td><td>: {{ $suratUndangan->jenis_kegiatan }} &mdash; {{ $suratUndangan->judul }}</td></tr>
    <tr><td>Hari/Tanggal</td><td>: {{ \Carbon\Carbon::parse($suratUndangan->tanggal_acara)->translatedFormat('l, d F Y') }}</td></tr>
    <tr><td>Waktu</td><td>: {{ $suratUndangan->waktu ?? '-' }}</td></tr>
    <tr><td>Tempat</td><td>: {{ $suratUndangan->tempat ?? '-' }}</td></tr>
  </table>

  <p>{{ $suratUndangan->isi }}</p>

  <p>Demikian undangan ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu/Saudara/i, kami ucapkan terima kasih.</p>

  <p style="margin-top: 40px;">
    Citra Indah City, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}<br>
    Ketua RT 09 / RW 10
  </p>
</body>
</html>
