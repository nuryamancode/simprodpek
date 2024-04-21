<?php

namespace App\Models;

use App\Models\Penilaian\Penilaiankaryawan;
use App\Models\Penilaian\PenilaianRekanKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MKaryawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'no_handphone',
        'foto_profil',
        'user_id',
        'bidang_id',
    ];
    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function bidang() : BelongsTo
    {
        return $this->belongsTo(MBidang::class);
    }
    public function tim() : BelongsToMany
    {
        return $this->belongsToMany(MTim::class);
    }
    public function tugas() : HasOne
    {
        return $this->hasOne(MTugas::class, 'm_karyawan_id');
    }
    public function penilaiankaryawan() : HasOne
    {
        return $this->hasOne(Penilaiankaryawan::class, 'karyawan_id');
    }
    public function penilaianrekankerja() : HasOne
    {
        return $this->hasOne(PenilaianRekanKerja::class, 'karyawan_id');
    }
}
