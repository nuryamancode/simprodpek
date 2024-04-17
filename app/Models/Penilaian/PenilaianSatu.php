<?php

namespace App\Models\Penilaian;

use App\Models\MKaryawan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianSatu extends Model
{
    use HasFactory;
    protected $table = 'penilaian_tahap_satu';
    protected $fillable = [
    'status_penilaian',
    'karyawan_id',
    'penilai_id',
    ];
    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function karyawan() : BelongsTo
    {
        return $this->belongsTo(MKaryawan::class);
    }
    public function penilai(): BelongsTo
    {
        return $this->belongsTo(Penilai::class, 'penilai_id');
    }
}
