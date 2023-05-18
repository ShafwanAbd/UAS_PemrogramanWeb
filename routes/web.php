<?php

use App\Http\Controllers\DistribusiLainnyaController;
use App\Http\Controllers\DistribusiZakatController;
use App\Http\Controllers\KategoriMustahikController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\PengumpulanZakatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {return view('welcome');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/beranda', [MainController::class, 'beranda']);

Route::get('/get_jumlah_tanggungan_muzakki/{namaMuzakki}', [MainController::class, 'getJumlahTanggunganMuzakki']);
Route::get('/get_kategori_muzakki/{kategori}', [MainController::class, 'getKategoriMuzakki']); 

Route::get('/laporan/ringkasan', [LaporanController::class, 'ringkasan']); 
Route::get('/laporan/distribusiWarga', [LaporanController::class, 'laporanWarga']); 
Route::get('/laporan/distribusiLainnya', [LaporanController::class, 'laporanLainnya']); 

Route::post('/zakatFitrah/pengumpulanZakat/addTerima/{id}', [PengumpulanZakatController::class, 'addTerima']);
Route::get('/zakatFitrah/pengumpulanZakat/resetTotalUang', [PengumpulanZakatController::class, 'resetTotalUang']);
Route::get('/zakatFitrah/pengumpulanZakat/destroyAll', [PengumpulanZakatController::class, 'destroyAll']);

Route::post('/zakatFitrah/distribusiZakat/addTerima/{id}', [DistribusiZakatController::class, 'addTerima']);
Route::get('/zakatFitrah/distribusiZakat/destroyAll', [DistribusiZakatController::class, 'destroyAll']);

Route::post('/zakatFitrah/distribusiLainnya/addTerima/{id}', [DistribusiLainnyaController::class, 'addTerima']);
Route::get('/zakatFitrah/distribusiLainnya/destroyAll', [DistribusiLainnyaController::class, 'destroyAll']);

Route::resource('/zakatFitrah/dataMuzakki', MuzakkiController::class);
Route::resource('/zakatFitrah/dataKategoriMustahik', KategoriMustahikController::class);
Route::resource('/zakatFitrah/pengumpulanZakat', PengumpulanZakatController::class);

Route::resource('/zakatFitrah/distribusiZakat', DistribusiZakatController::class); 

Route::resource('/zakatFitrah/distribusiLainnya', DistribusiLainnyaController::class);



Auth::routes();

Route::middleware(['auth'])->group(function(){
});

