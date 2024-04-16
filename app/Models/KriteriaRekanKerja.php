<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KriteriaRekanKerja extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_kriteria",
        "bobot_kriteria",
    ];
    protected $table = 'kriteria_rekan_kerja';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function SubKriteriaRekanKerja(): HasOne
    {
        return $this->hasOne(SubKriteriaRekanKerja::class, 'kriteria_id');
    }
}
