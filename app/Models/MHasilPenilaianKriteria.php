<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MHasilPenilaianKriteria extends Model
{
    use HasFactory;
    protected $table = "hasil_penilaian_kriteria";
    protected $fillable = [
        'periode_id',
        'kriteria_id',
        'total_nilai_perkriteria',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kriteria() : BelongsTo
    {
        return $this->belongsTo(MKriteria::class);
    }
}
