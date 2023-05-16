<?php

namespace App\Http\Controllers;

use App\Models\DistribusiZakat;
use App\Models\KategoriMustahik;
use App\Models\Muzakki;
use App\Models\Result;
use Illuminate\Http\Request; 

class DistribusiZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        $keyword = "";

        if ($request->keyword){
            $keyword = $request->keyword;

            $query = DistribusiZakat::query();
            $columns = ['id', 'nama', 'kategori', 'hak', 'NIK', 'noKK'];

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
            }

            $datas = $query->get();
        } else {
            $datas = DistribusiZakat::where('terima', 0)->get();
        }
        $datas_accepted = DistribusiZakat::where('terima', 1)->get();
        $datas1 = Muzakki::all();
        $datas2 = KategoriMustahik::all();
        $datas2_warga = KategoriMustahik::whereIn('namaKategori', ['Fakir', 'Mampu', 'Miskin'])->get();
        $datas3 = Result::all();
        $result = Result::first();


        return view('zakatFitrah.distribusiZakat', compact('datas', 'datas1', 'datas2', 'datas2_warga', 'datas3', 'datas_accepted', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new DistribusiZakat;
 
        $model->nama = $request->nama;
        $model->kategori = $request->kategori;
        $model->hak = $request->hak;
        $model->NIK = $request->NIK;
        $model->noKK = $request->noKK;  
        $model->terima = 0;  

        $model->save();

        return redirect('/zakatFitrah/distribusiZakat')->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = DistribusiZakat::find($id);
 
        $model->nama = $request->nama;
        $model->kategori = $request->kategori;
        $model->hak = $request->hak;
        $model->NIK = $request->NIK;
        $model->noKK = $request->noKK; 

        $model->save();
        
        return redirect('/zakatFitrah/distribusiZakat')->with('success', 'Berhasil Mengubah Data!');
    }

    public function addTerima(string $id, Request $request)
    {
        $model = DistribusiZakat::find($id);

        $model->terima = 1; 

        $model2 = Result::firstOrCreate([], [
            'totalUang' => $request->bayarUang,
            'totalBeras' => $request->bayarBeras
        ]);   

        if ($model->hak > $model2->totalUang && isset($request->bayarUang)){
            return redirect('/zakatFitrah/distribusiZakat')->with('failed', 'Jumlah Total Uang Kurang!');
        } else if ($model->hak/16000 > $model2->totalBeras && isset($request->bayarBeras)){
            return redirect('/zakatFitrah/distribusiZakat')->with('failed', 'Jumlah Total Beras Kurang!');
        }

        if ($request->bayarUang){
            $model2->totalUang -= $request->bayarUang;
            $model->jenisTerima = 'Uang';
        } else if ($request->bayarBeras){
            $model2->totalBeras -= $request->bayarBeras;
            $model->jenisTerima = 'Beras';
        }
        
        $model->save();
        $model2->save();

        return redirect('/zakatFitrah/distribusiZakat')->with('success', 'Berhasil Menerima Mustahik!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $model = DistribusiZakat::find($id);
        $model->delete();

        return redirect('/zakatFitrah/distribusiZakat')->with('success', 'Berhasil Menghapus Data!');
    }  

    public function destroyAll()
    { 
        DistribusiZakat::truncate();

        return redirect('/zakatFitrah/distribusiZakat')->with('success', 'Berhasil Menghapus Semua Data!');
    }  
}
