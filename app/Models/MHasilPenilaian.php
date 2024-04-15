<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MHasilPenilaian extends Model
{
    use HasFactory;
    protected $table = "hasil_penilaian";
    protected $fillable = [
        'periode_id',
        'total_nilai_akhir',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function periode() : BelongsTo
    {
        return $this->belongsTo(MPeriode::class);
    }
}
