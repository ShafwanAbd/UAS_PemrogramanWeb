<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_mustahik', function (Blueprint $table) {
            $table->id();
            $table->string('namaKategori');  
            $table->string('jumlahHak');   
            $table->timestamps();
        });

        DB::table('kategori_mustahik')->insert(
            array(
                ['namaKategori' => 'Fakir',
                 'jumlahHak' => '65000'],

                 ['namaKategori' => 'Miskin',
                 'jumlahHak' => '60000'],

                 ['namaKategori' => 'Mampu',
                 'jumlahHak' => '55000'],

                 ['namaKategori' => 'Amil',
                 'jumlahHak' => '50000'],

                 ['namaKategori' => 'Mu\'allaf',
                 'jumlahHak' => '45000'],

                 ['namaKategori' => 'Riqab',
                 'jumlahHak' => '40000'],

                 ['namaKategori' => 'Gharim',
                 'jumlahHak' => '40000'],

                 ['namaKategori' => 'Fi Sabilillah',
                 'jumlahHak' => '40000'],

                 ['namaKategori' => 'Ibnu Sabil',
                 'jumlahHak' => '40000'],

            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_mustahik');
    }
};
