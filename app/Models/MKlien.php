<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKlien extends Model
{
    use HasFactory;
    protected $table = 'klien';
    protected $fillable = [
        'nama_klien',
        'alamat',
        'nomor_handphone',
        'berkas_klien',
        'email',

    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function proyek()
    {
        return $this->hasOne(MProyek::class);
    }
}
