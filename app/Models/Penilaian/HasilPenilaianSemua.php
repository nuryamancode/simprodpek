<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilPenilaianSemua extends Model
{
    use HasFactory;
    protected $table = "hasil_penilaian_rekankerja_total";
    protected $fillable = [
        'total_akhir_semua',
        'periode',
        'karyawan_id',
    ];
    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

}
