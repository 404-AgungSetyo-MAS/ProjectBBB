<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

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

    protected static function booted():void
    {
        // static::deleted(function (Perjalanan $perjalanan) {
        //     foreach($perjalanan->files as $file) {
        //         Storage::delete($file);
        //     }
        // });
        // static::updating(function (Perjalanan $perjalanan) {

        //     $deleteFiles = array_diff($perjalanan->getOriginal('files'), $perjalanan->files);

        //     foreach($deleteFiles as $file) {
        //         Storage::delete($file);
        //     }
        // });
    }


    public function mak(): BelongsTo
    {
        return $this->belongsTo(Mak::class);
    }
}
