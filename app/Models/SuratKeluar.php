<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by', 'nomor_surat', 'tanggal', 'tujuan', 'perihal', 'isi', 'file',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
