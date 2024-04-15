<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MTim extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_tim",
    ];
    protected $table = 'tim';
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function karyawan() : BelongsToMany
    {
        return $this->belongsToMany(MKaryawan::class);
    }
    public function proyek() : HasOne
    {
        return $this->hasOne(MProyek::class);
    }
}
