<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MTugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = [
        'm_karyawan_id',
        'proyek_id',
        'fase_proyek',
        'direktur_id',
        'nama_tugas',
        'catatan_karyawan',
        'keterangan_tugas',
        'deadline_tugas',
        'berkas_tugas',
        'catatan_revisi',
        'upload_berkas',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function karyawan() : BelongsTo
    {
        return $this->belongsTo(MKaryawan::class, 'm_karyawan_id');
    }
    public function direktur() : BelongsTo
    {
        return $this->belongsTo(MDirektur::class);
    }
    public function proyek() : BelongsTo
    {
        return $this->belongsTo(MProyek::class);
    }
}
