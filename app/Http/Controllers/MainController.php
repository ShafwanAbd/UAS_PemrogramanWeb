<?php

namespace App\Http\Controllers;
 
use App\Models\KategoriMustahik;
use App\Models\Muzakki;
use App\Models\PengumpulanZakat;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;

class MainController extends Controller
{
    public function beranda()
    {
        return view('home.homeMain');
    }

    public function dataMuzakki()
    {
        return view('zakatFitrah.muzakki');
    }

    public function getJumlahTanggunganMuzakki($namaMuzakki)
    {
        $jumlahTanggungan = Muzakki::where('namaMuzakki', $namaMuzakki)->value('jumlahTanggungan');

        return response()->json(['jumlahTanggungan' => $jumlahTanggungan]);
    }

    public function getKategoriMuzakki($kategori)
    {
        $jumlahHak = KategoriMustahik::where('namaKategori', $kategori)->value('jumlahHak');

        return response()->json(['jumlahHak' => $jumlahHak]);
    }   
}
