<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nik', 'nama', 'email', 'no_hp', 'jenis_kelamin',
        'tanggal_lahir', 'alamat', 'status_warga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rumahs()
    {
        return $this->hasMany(Rumah::class);
    }

    public function ipls()
    {
        return $this->hasMany(Ipl::class);
    }

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }
}
