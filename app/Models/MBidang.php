<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MBidang extends Model
{
    use HasFactory;
    protected $table = 'bidang';
    protected $fillable = [
        'nama_bidang',
    ];

    public function karyawan(): HasOne
    {
        return $this->hasOne(MKaryawan::class, 'bidang_id');
    }
}
