<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JenisPenilaian extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_penilai',
        'nilai_bobot',
    ];
    protected $table = 'jenis_penilaian';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function penilai(): HasOne
    {
        return $this->hasOne(Penilai::class);
    }
}
