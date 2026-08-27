<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id', 'nomor_surat', 'jenis_surat', 'perihal', 'keterangan',
        'status', 'catatan_admin', 'tanggal_pengajuan',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
