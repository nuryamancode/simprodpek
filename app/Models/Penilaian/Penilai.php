<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'periode_id',
        'jenis_penilai_id',
        'jenis_dinilai',
        'status_penilaian',
    ];
    protected $table = 'kelola_penilai';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function jenispenilaian(): BelongsTo
    {
        return $this->belongsTo(JenisPenilaian::class, 'jenis_penilai_id');
    }
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }

}
