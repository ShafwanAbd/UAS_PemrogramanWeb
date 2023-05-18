<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLainnya;
use App\Models\KategoriMustahik;
use App\Models\Muzakki;
use App\Models\Result;
use Illuminate\Http\Request; 

class DistribusiLainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        $keyword = "";

        if ($request->keyword){
            $keyword = $request->keyword;

            $query = DistribusiLainnya::query();
            $columns = ['id', 'nama', 'kategori', 'hak', 'NIK', 'noKK'];

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
            }

            $datas = $query->get();
        } else {
            $datas = DistribusiLainnya::where('terima', 0)->get();
        }
        $datas_accepted = DistribusiLainnya::where('terima', 1)->get();
        $datas1_pre = DistribusiLainnya::where('added', 1)->pluck('nama');
        $datas1 = Muzakki::whereNotIn('namaMuzakki', $datas1_pre)
                            ->where('isWarga', 0)
                            ->get(); 
        $datas2 = KategoriMustahik::all();
        $datas2_lainnya = KategoriMustahik::whereNotIn('namaKategori', ['Fakir', 'Mampu', 'Miskin', 'Riqab', 'Gharim'])->get();
        $datas3 = Result::all();
        $result = Result::first();


        return view('zakatFitrah.distribusiLainnya', compact('datas', 'datas1', 'datas2', 'datas2_lainnya', 'datas3', 'datas_accepted', 'result'));
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
        $model = new DistribusiLainnya;
        $model2 = Muzakki::where('namaMuzakki', $request->nama)->first();
 
        $model->nama = $request->nama;
        $model->kategori = $request->kategori;
        $model->hak = $request->hak;
        $model->NIK = $request->NIK;
        $model->noKK = $request->noKK;  
        $model->terima = 0;  
        $model->added = 1;   
        
        $model2->isLainnya = 1;

        $model->save();
        $model2->save();

        return redirect('/zakatFitrah/distribusiLainnya')->with('success', 'Berhasil Menambahkan Data!');
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
        $model = DistribusiLainnya::find($id);
 
        $model->nama = $request->nama;
        $model->kategori = $request->kategori;
        $model->hak = $request->hak;
        $model->NIK = $request->NIK;
        $model->noKK = $request->noKK; 
  
        $model->save(); 
        
        return redirect('/zakatFitrah/distribusiLainnya')->with('success', 'Berhasil Mengubah Data!');
    }

    public function addTerima(string $id, Request $request)
    {
        $model = DistribusiLainnya::find($id);

        $model->terima = 1; 

        $model2 = Result::firstOrCreate([], [
            'totalUang' => $request->bayarUang,
            'totalBeras' => $request->bayarBeras
        ]);   

        if ($model->hak > $model2->totalUang && isset($request->bayarUang)){
            return redirect('/zakatFitrah/distribusiLainnya')->with('failed', 'Jumlah Total Uang Kurang!');
        } else if ($model->hak/16000 > $model2->totalBeras && isset($request->bayarBeras)){
            return redirect('/zakatFitrah/distribusiLainnya')->with('failed', 'Jumlah Total Beras Kurang!');
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

        return redirect('/zakatFitrah/distribusiLainnya')->with('success', 'Berhasil Menerima Mustahik!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $model = DistribusiLainnya::find($id);
        $model2 = Muzakki::where('namaMuzakki', $model->nama)->first(); 

        $model2->isLainnya = 0;

        $model2->save();
        $model->delete();

        return redirect('/zakatFitrah/distribusiLainnya')->with('success', 'Berhasil Menghapus Data!');
    }  

    public function destroyAll()
    { 
        DistribusiLainnya::truncate();

        return redirect('/zakatFitrah/distribusiLainnya')->with('success', 'Berhasil Menghapus Semua Data!');
    }  
}
