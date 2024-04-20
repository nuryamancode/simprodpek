<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianDua extends Model
{
    use HasFactory;
    protected $table = 'penilaian_tahap_dua';
    protected $fillable = [
    'rating',
    'penilaianrekan_id',
    'penilaiankaryawan_id',
    ];
    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function penilaiankaryawan(): BelongsTo
    {
        return $this->belongsTo(Penilaiankaryawan::class);
    }
    public function penilaianrekankerja() : BelongsTo
    {
        return $this->belongsTo(PenilaianRekanKerja::class);
    }
}
