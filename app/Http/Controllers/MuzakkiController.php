<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLainnya;
use App\Models\DistribusiZakat;
use App\Models\Muzakki;
use App\Models\PengumpulanZakat;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MuzakkiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = "";

        if ($request->keyword){
            $keyword = $request->keyword;

            $query = Muzakki::query();
            $columns = ['id', 'namaMuzakki', 'jumlahTanggungan', 'keterangan', 'NIK', 'noKK'];

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
            }

            $datas = $query->get();
        } else {
            $datas = Muzakki::all();
        }
        $result = Result::first();
        $datas2 = PengumpulanZakat::all();
        $datas_jumlahTanggungan = Muzakki::all();


        return view('zakatFitrah.muzakki', compact('datas', 'datas2', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Muzakki;

        return view('zakatFitrah.create', compact(
            'model'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new Muzakki;
 
        $model->namaMuzakki = $request->namaMuzakki;
        $model->jumlahTanggungan = $request->jumlahTanggungan;
        $model->keterangan = $request->keterangan;
        $model->NIK = $request->NIK;
        $model->noKK = $request->noKK;
        $model->isWarga = 0;
        $model->isLainnya = 0;

        $model->save();

        return redirect('/zakatFitrah/dataMuzakki')->with('success', 'Berhasil Menambahkan Data!');
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
        $model = Muzakki::find($id);
  
        PengumpulanZakat::where('namaKK', $model->namaMuzakki)
                        ->update([
                            'namaKK' => $request->namaMuzakki, 
                            'jumlahTanggungan' => $request->jumlahTanggungan,
                        ]);  
  
        DistribusiZakat::where('nama', $model->namaMuzakki)
                        ->update([
                            'nama' => $request->namaMuzakki, 
                        ]);  

        DistribusiLainnya::where('nama', $model->namaMuzakki)
                        ->update([
                            'nama' => $request->namaMuzakki, 
                        ]);  

        $model->namaMuzakki = $request->namaMuzakki;
        $model->jumlahTanggungan = $request->jumlahTanggungan;
        $model->keterangan = $request->keterangan;
        $model->NIK = $request->NIK;
        $model->noKK = $request->noKK; 
        
        $model->save();

        return redirect('/zakatFitrah/dataMuzakki')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $model = Muzakki::find($id);
        $model->delete();

        return redirect('/zakatFitrah/dataMuzakki')->with('success', 'Berhasil Menghapus Data!');
    }
}
