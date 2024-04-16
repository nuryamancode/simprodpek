<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KelolaPenilai extends Model
{
    use HasFactory;
    protected $fillable = [
        'periode',
        'jenis_penilai_id',
        'jenis_dinilai',
        'status_penilaian',
    ];
    protected $table = 'kelola_penilai';
    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function jenispenilaian() : BelongsTo{
        return $this->belongsTo(JenisPenilaian::class, 'jenis_penilai_id');
    }
}
