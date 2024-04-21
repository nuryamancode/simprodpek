<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPenilaianDirektur extends Model
{
    use HasFactory;
    protected $table = "hasil_penilaian_direktur";
    protected $fillable = [
        'total_akhir',
        'periode_id',
        'karyawan_id',
        'penilaian_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
    public function penilaiankaryawan(): BelongsTo
    {
        return $this->belongsTo(Penilaiankaryawan::class, 'periode_id');
    }
}
