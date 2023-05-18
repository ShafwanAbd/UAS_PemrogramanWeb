<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLainnya;
use App\Models\DistribusiZakat;
use App\Models\KategoriMustahik;
use App\Models\Muzakki;
use App\Models\Result;
use Illuminate\Http\Request;

class LaporanController extends Controller
{ 
    public function ringkasan(){
        $datas['result'] = Result::first();
        $datas['muzakki'] = Muzakki::all()->count();
        $datas['tanggungan'] = 0;
 
        $datas['fakir'] = DistribusiZakat::where('kategori', 'Fakir')->count();
        $datas['miskin'] = DistribusiZakat::where('kategori', 'Miskin')->count();
        $datas['mampu'] = DistribusiZakat::where('kategori', 'Mampu')->count();
 
        $datas['amil'] = DistribusiLainnya::where('kategori', 'Amil')->count();
        $datas['muallaf'] = DistribusiLainnya::where('kategori', 'Mu\'allaf')->count();
        $datas['riqab'] = DistribusiLainnya::where('kategori', 'Riqab')->count();
        $datas['gharim'] = DistribusiLainnya::where('kategori', 'Gharim')->count();
        $datas['fiSabilillah'] = DistribusiLainnya::where('kategori', 'Fi Sabilillah')->count();
        $datas['ibnuSabil'] = DistribusiLainnya::where('kategori', 'Ibnu Sabil')->count();
        $datas['lainnya'] = DistribusiLainnya::whereNotIn('kategori', ['Amil','Mu\'allaf', 'Riqab', 'Gharim', 'Fi Sabilillah', 'Ibnu Sabil'])->count();

        $tanggungan = Muzakki::all()->pluck('jumlahTanggungan');
        foreach($tanggungan as $i){
            $datas['tanggungan'] += $i;
        } 
        
        return view('laporan.ringkasan', compact(
            'datas'
        ));
    }

    public function laporanWarga()
    { 
        $fakir = DistribusiZakat::where('kategori', 'Fakir')->where('terima', 1)->first();
        $miskin = DistribusiZakat::where('kategori', 'Miskin')->where('terima', 1)->first();
        $mampu = DistribusiZakat::where('kategori', 'Mampu')->where('terima', 1)->first();

        $fakirAll = DistribusiZakat::where('kategori', 'Fakir')->where('terima', 1)->get();
        $miskinAll = DistribusiZakat::where('kategori', 'Miskin')->where('terima', 1)->get();
        $mampuAll = DistribusiZakat::where('kategori', 'Mampu')->where('terima', 1)->get();

        $datas = collect([$fakir, $miskin, $mampu]);
        $datas2 = DistribusiZakat::where('terima', 1)->get();

        return view('laporan.distribusiWarga', compact(
            'datas', 'datas2', 'fakirAll', 'miskinAll', 'mampuAll'
        ));
    }   
    public function laporanLainnya()
    { 
        $amil = DistribusiLainnya::where('kategori', 'Amil')->where('terima', 1)->first();
        $muallaf = DistribusiLainnya::where('kategori', 'Mu\'allaf')->where('terima', 1)->first();
        $fiSabilillah = DistribusiLainnya::where('kategori', 'Fi Sabilillah')->where('terima', 1)->first();
        $ibnuSabil = DistribusiLainnya::where('kategori', 'Ibnu Sabil')->where('terima', 1)->first();

        $amilAll = DistribusiLainnya::where('kategori', 'Amil')->where('terima', 1)->get();
        $muallafAll = DistribusiLainnya::where('kategori', 'Mu\'allaf')->where('terima', 1)->get();
        $fiSabilillahAll = DistribusiLainnya::where('kategori', 'Fi Sabilillah')->where('terima', 1)->get();
        $ibnuSabilAll = DistribusiLainnya::where('kategori', 'Ibnu Sabil')->where('terima', 1)->get();

        $lainnya = DistribusiLainnya::whereNotIn('kategori', ['Amil', 'Mu\'allaf', 'Fi Sabilillah', 'Ibnu Sabil'])->where('terima', 1)->get(); 
   
        $datas = collect([$amil, $muallaf, $fiSabilillah, $ibnuSabil]);
        $datas2 = DistribusiLainnya::where('terima', 1)->get();

        return view('laporan.distribusiLainnya', compact(
            'datas', 'datas2', 'lainnya', 'amilAll', 'muallafAll', 'fiSabilillahAll', 'ibnuSabilAll'
        ));
    }   
}
