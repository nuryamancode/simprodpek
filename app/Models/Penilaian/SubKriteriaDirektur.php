<?php

namespace App\Models\Penilaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKriteriaDirektur extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_subkriteria",
        "pertanyaan",
        "bobot_sub",
        "kriteria_id",
    ];
    protected $table = 'sub_kriteria_direktur';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kriteriaDirektur() : BelongsTo
    {
        return $this->belongsTo(KriteriaDirektur::class, 'kriteria_id');
    }
}
