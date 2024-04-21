<?php

namespace App\Models\Penilaian;

use App\Models\MKaryawan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TotalAkhir extends Model
{
    use HasFactory;
    protected $table = "total_akhir";
    protected $fillable = [
        'karyawan_id',
        'hasildirektur_id',
        'hasilrekankerja_id',
        'periode_id',
        'total_akhir',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function hasildirektur(): BelongsTo
    {
        return $this->belongsTo(HasilPenilaianDirektur::class, 'hasildirektur_id');
    }
    public function hasilrekankerja(): BelongsTo
    {
        return $this->belongsTo(HasilPenilaianSemua::class, 'hasilrekankerja_id');
    }
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(MKaryawan::class, 'karyawan_id');
    }
}
