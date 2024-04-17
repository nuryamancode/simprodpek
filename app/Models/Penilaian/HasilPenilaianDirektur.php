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
        'tahap_satu_id',
    ];
    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function penilaiansatu() : BelongsTo
    {
        return $this->belongsTo(PenilaianSatu::class);
    }
}
