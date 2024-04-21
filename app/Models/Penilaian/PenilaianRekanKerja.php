<?php

namespace App\Models\Penilaian;

use App\Models\MKaryawan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianRekanKerja extends Model
{
    use HasFactory;
    protected $table = 'penilaian_rekankerja';
    protected $fillable = [
        'status_penilaian',
        'karyawan_id',
        'karyawan_menilai_id',
        'periode_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(MKaryawan::class);
    }
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
