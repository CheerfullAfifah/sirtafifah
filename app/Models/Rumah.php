<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rumah extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id', 'nomor_rumah', 'blok', 'nama_pemilik', 'nama_penghuni', 'status_hunian',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function ipls()
    {
        return $this->hasMany(Ipl::class);
    }
}
