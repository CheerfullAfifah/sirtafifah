<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratUndangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'nomor', 'jenis_kegiatan', 'judul', 'tanggal_acara', 'waktu', 'tempat', 'isi',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
