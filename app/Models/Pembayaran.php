<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'ipl_id', 'warga_id', 'nominal', 'metode', 'bukti_pembayaran',
        'tanggal_bayar', 'status', 'catatan',
    ];

    public function ipl()
    {
        return $this->belongsTo(Ipl::class);
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
