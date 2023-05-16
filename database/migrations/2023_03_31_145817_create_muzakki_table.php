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
        Schema::create('muzakki', function (Blueprint $table) {
            $table->id();
            $table->string('namaMuzakki');  
            $table->string('jumlahTanggungan');  
            $table->string('keterangan')->nullable();;  
            $table->string('NIK')->nullable();;  
            $table->string('noKK')->nullable();;  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muzakki');
    }
};
