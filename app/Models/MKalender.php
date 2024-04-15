<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MKalender extends Model
{
    use HasFactory;
    protected $table = 'kalender';
    protected $fillable = [
        'proyek_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function proyek(): BelongsTo
    {
        return $this->belongsTo(MProyek::class);
    }
}
