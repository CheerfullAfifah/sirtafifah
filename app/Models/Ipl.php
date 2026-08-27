<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ipl extends Model
{
    use HasFactory;

    protected $table = 'ipls';

    protected $fillable = [
        'warga_id', 'rumah_id', 'periode', 'nominal', 'tanggal_tagihan',
        'jatuh_tempo', 'status', 'keterangan',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
