<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MSubKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_subkriteria",
        "pertanyaan",
        "kriteria_id",
    ];
    protected $table = 'sub_kriteria';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function kriteria() : BelongsTo
    {
        return $this->belongsTo(MKriteria::class);
    }
    public function penilaian() : HasOne
    {
        return $this->hasOne(MPenilaian::class);
    }
}
