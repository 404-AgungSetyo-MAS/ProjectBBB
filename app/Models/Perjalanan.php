<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Perjalanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'mak_id',
        'kode_st',
        'nama_pelaksana',
        'maksud_perjalanan',
        'kota_tujuan',
        'tanggal_berangkat',
        'uang_harian',
        'uang_transport',
        'total_bayar_spj',
        'status',
        'files',
        'current_user',
    ];

    protected $casts = [
        'files' => 'json'
    ];

    public function mak(): BelongsTo
    {
        return $this->belongsTo(Mak::class);
    }
}
