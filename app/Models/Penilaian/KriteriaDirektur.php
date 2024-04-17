<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KriteriaDirektur extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_kriteria",
        "bobot_kriteria",
    ];
    protected $table = 'kriteria_direktur';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function SubKriteriaDirektur(): HasOne
    {
        return $this->hasOne(SubKriteriaDirektur::class, 'kriteria_id');
    }
}
