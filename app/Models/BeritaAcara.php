<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'berita_acaras';

    protected $fillable = [
        'created_by', 'nomor', 'judul', 'tanggal', 'tempat', 'isi', 'pihak_terkait', 'dokumentasi',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
