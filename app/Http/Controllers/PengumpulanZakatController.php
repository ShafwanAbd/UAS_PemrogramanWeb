<?php

namespace App\Http\Controllers;

use App\Models\KategoriMustahik;
use App\Models\Muzakki;
use App\Models\PengumpulanZakat;
use App\Models\Result;
use Illuminate\Http\Request; 

class PengumpulanZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { 
        $keyword = "";

        if ($request->keyword){
            $keyword = $request->keyword;

            $query = PengumpulanZakat::query();
            $columns = ['id', 'namaKK', 'jumlahTanggungan', 'jenisBayar', 'jumlahTanggunganDibayar', 'bayarBeras', 'bayarUang'];

            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $keyword . '%');
            }

            $datas = $query->get();
        } else {
            $datas = PengumpulanZakat::where('terima', 0)->get();
        }
        $datas_accepted = PengumpulanZakat::where('terima', 1)->get();
        $datas1 = Muzakki::all();
        $result = Result::first();


        return view('zakatFitrah.pengumpulanZakat', compact('datas', 'datas1', 'datas_accepted', 'result'));
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
        $model = new PengumpulanZakat;
 
        $model->namaKK = $request->namaKK;
        $model->jumlahTanggungan = $request->jumlahTanggungan;
        $model->jenisBayar = $request->jenisBayar;
        $model->jumlahTanggunganDibayar = $request->jumlahTanggunganDibayar;
        $model->bayarBeras = $request->bayarBeras;
        $model->bayarUang = $request->bayarUang;
        $model->terima = 0;
        $model->save();

        // $model2 = Result::firstOrCreate([], [
        //     'totalUang' => $request->bayarUang,
        //     'totalBeras' => $request->bayarBeras
        // ]);

        // $model2->totalUang += $request->bayarUang;
        // $model2->totalBeras += $request->bayarBeras;
        // $model2->save();

        return redirect('/zakatFitrah/pengumpulanZakat')->with('success', 'Berhasil Menambahkan Muzakki!');
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
        $model = PengumpulanZakat::find($id);
 
        $model->namaKK = $request->namaKK;
        $model->jumlahTanggungan = $request->jumlahTanggungan;
        $model->jenisBayar = $request->jenisBayar;
        $model->jumlahTanggunganDibayar = $request->jumlahTanggunganDibayar;
        $model->bayarBeras = $request->bayarBeras;
        $model->bayarUang = $request->bayarUang;

        $model->save();

        return redirect('/zakatFitrah/pengumpulanZakat')->with('success', 'Berhasil Mengubah Muzakki!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    { 
        $model = PengumpulanZakat::find($id);
        $model->delete(); 

        return redirect('/zakatFitrah/pengumpulanZakat')->with('success', 'Berhasil Menghapus Muzakki!');
    }

    public function destroyAll()
    { 
        PengumpulanZakat::truncate(); 

        return redirect('/zakatFitrah/pengumpulanZakat')->with('success', 'Berhasil Menghapus Semua Muzakki!');
    }

    public function addTerima(string $id, Request $request)
    {
        $model = PengumpulanZakat::find($id);

        $model->terima = 1; 
        $model->save();

        $model2 = Result::firstOrCreate([], [
            'totalUang' => $request->bayarUang,
            'totalBeras' => $request->bayarBeras
        ]);

        if ($request->bayarUang){
            $model2->totalUang += $request->bayarUang;
            $model2->save();
        } else if ($request->bayarBeras){
            $model2->totalBeras += $request->bayarBeras;
            $model2->save();
        }

        return redirect('/zakatFitrah/pengumpulanZakat')->with('success', 'Berhasil Menerima Muzakki!'); 
    }

    public function resetTotalUang()
    { 
        $model = Result::first();
        if ($model){
            $model->update([
                'totalUang' => 0,
                'totalBeras' => 0   
            ]);
        } 

        return back()->with('success', 'Berhasil Mereset Total Beras/Uang!');
    }
}
