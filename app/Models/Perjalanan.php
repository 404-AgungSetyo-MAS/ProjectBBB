<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perjalanan extends Model
{
    use HasFactory;

    protected $casts = [
        'files' => 'json'
    ];

    public function mak(): BelongsTo
    {
        return $this->belongsTo(Mak::class);
    }
}
