<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MDirektur extends Model
{
    use HasFactory;
    protected $table = 'direktur';
    protected $fillable = [
        'nama_lengkap',
        'email',
        'alamat',
        'no_handphone',
        'foto_profil',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
