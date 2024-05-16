<?php

use App\Models\MAK;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perjalanans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('mak_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Mak::class);
            $table->string('kode_st')->nullable();
            $table->string('maksud_perjalanan')->nullable();
            $table->string('nama_pelaksana')->nullable();
            $table->string('kota_tujuan')->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->integer('uang_harian')->nullable();
            $table->integer('uang_transport')->nullable();
            $table->integer('total_bayar_spj')->nullable();
            $table->string('status')->nullable();
            $table->json('files')->nullable();
            $table->string('current_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanans');
    }
};
