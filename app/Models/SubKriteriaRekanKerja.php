<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKriteriaRekanKerja extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_subkriteria",
        "pertanyaan",
        "bobot_sub",
        "kriteria_id",
    ];
    protected $table = 'sub_kriteria_rekan_kerja';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kriteriaRekanKerja() : BelongsTo
    {
        return $this->belongsTo(KriteriaRekanKerja::class, 'kriteria_id');
    }
}
