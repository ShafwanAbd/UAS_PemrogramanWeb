<?php

namespace App\Http\Controllers;

use App\Models\DistribusiLainnya;
use App\Models\DistribusiZakat;
use App\Models\KategoriMustahik;
use App\Models\Muzakki;
use Illuminate\Http\Request; 

class KategoriMustahikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = "";

        if ($request->keyword){
            $keyword = $request->keyword;

            $query = KategoriMustahik::query();
            $columns = ['id', 'namaKategori', 'jumlahHak'];

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
            }

            $datas = $query->get();
        } else {
            $datas = KategoriMustahik::all();
        }


        return view('zakatFitrah.kategoriMustahik', compact('datas'));
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
        $model = new KategoriMustahik;
 
        $model->namaKategori = $request->namaKategori;
        $model->jumlahHak = $request->jumlahHak; 

        $model->save();

        return redirect('/zakatFitrah/dataKategoriMustahik')->with('success', 'Berhasil Menambahkan Data!');
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
        $model = KategoriMustahik::find($id);

        DistribusiZakat::where('kategori', $model->namaKategori)
                        ->where('terima', 0)
                        ->update([
            'kategori' => $request->namaKategori,
            'hak' => $request->jumlahHak,
        ]);

        DistribusiLainnya::where('kategori', $model->namaKategori)
                        ->where('terima', 0)
                        ->update([
            'kategori' => $request->namaKategori,
            'hak' => $request->jumlahHak,
        ]);
 
        $model->namaKategori = $request->namaKategori;
        $model->jumlahHak = $request->jumlahHak;  
        $model->save(); 


        return redirect('/zakatFitrah/dataKategoriMustahik')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $model = KategoriMustahik::find($id);
        $model->delete();

        return redirect('/zakatFitrah/dataKategoriMustahik')->with('success', 'Berhasil Menghapus Data!');
    }
}
