<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MProyek extends Model
{
    use HasFactory;
    protected $table = 'proyek';
    protected $fillable = [
        'nama_proyek',
        'tanggal_mulai',
        'tanggal_selesai',
        'berkas',
        'status_proyek',
        'klien_id',
        'tim_id'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function klien(): BelongsTo
    {
        return $this->belongsTo(MKlien::class);
    }
    public function tim(): BelongsTo
    {
        return $this->belongsTo(MTim::class);
    }

    public function tugas() : HasOne
    {
        return $this->hasOne(MTugas::class);
    }
    public function kalender() : HasOne
    {
        return $this->hasOne(MKalender::class);
    }
}
