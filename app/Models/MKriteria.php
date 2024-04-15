<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_kriteria",
        "bobot_kriteria",
    ];
    protected $table = 'kriteria';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function sub_kriteria(): HasOne
    {
        return $this->hasOne(MSubKriteria::class);
    }
    public function hasilkriteria(): HasOne
    {
        return $this->hasOne(MHasilPenilaianKriteria::class);
    }
}
