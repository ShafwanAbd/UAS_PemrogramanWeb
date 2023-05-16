<?php

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
        Schema::create('bayar_zakat', function (Blueprint $table) {
            $table->id();
            $table->string('namaKK');
            $table->string('jumlahTanggungan');
            $table->string('jenisBayar');
            $table->string('jumlahTanggunganDibayar');
            $table->string('bayarBeras')->nullable();
            $table->string('bayarUang')->nullable();
            $table->string('terima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayar_zakat');
    }
};
