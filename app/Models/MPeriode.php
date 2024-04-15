<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MPeriode extends Model
{
    use HasFactory;
    protected $table = "periode";
    protected $fillable = [
        'tanggal_periode',
        'status_periode',
        'karyawan_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(MKaryawan::class,);
    }
    public function totalakhir(): HasOne
    {
        return $this->hasOne(MHasilPenilaian::class, 'periode_id');
    }
}
