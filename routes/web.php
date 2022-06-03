<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormPenilaianCont;
use App\Http\Controllers\FormJenisCont;
use App\Http\Controllers\FormKategoriCont;
use App\Http\Controllers\FormPoinCont;
use App\Http\Controllers\FormKaryawanCont;
use App\Models\Poin;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Karyawan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    $poin = Poin::count();
    $kategori = Kategori::count();
    $jenis = Jenis::count();
    $karyawan = Karyawan::count();
    return view('page.dashboard',compact('poin','kategori','jenis','karyawan'));
});


//FrontEnd Form Penilaian
Route::get('/form/{slug_jenis}',[FormJenisCont::class,'form_penilaian']);
Route::get('/find-nama-karyawan',[FormJenisCont::class,'find_nama_karyawan'])->name('find_karyawan');
Route::post('/form-penilaian',[FormJenisCont::class,'form_penilaian_karyawan'])->name('form_penilaian');
Route::post('/submit-form-penilaian',[FormJenisCont::class,'submit_form'])->name('submit-form-penilaian');
Route::post('/submit-form-berhalangan',[FormJenisCont::class,'submit_berhalangan'])->name('submit-form-berhalangan');


//backend jenis
Route::get('/jenis-form-penilaian',[FormJenisCont::class,'index_jenis'])->name('be_index_jenis');
Route::post('/jenis-form-store',[FormJenisCont::class,'store_jenis'])->name('be_store_jenis');
Route::post('/jenis-form-update',[FormJenisCont::class,'update_jenis'])->name('be_update_jenis');

//backend kategori
Route::get('/kategori-form-penilaian',[FormKategoriCont::class,'index_kategori'])->name('be_index_kategori');
Route::get('/kategori-form-penilaian/{slug_jenis}',[FormKategoriCont::class,'index_kategori_jenis']);
Route::post('/kategori-form-store',[FormKategoriCont::class,'store_kategori'])->name('be_store_kategori');
Route::post('/kategori-form-delete',[FormKategoriCont::class,'delete_kategori'])->name('be_delete_kategori');

//backend poin
Route::post('/poin-form-store',[FormPoinCont::class,'store_poin'])->name('be_store_poin');

//backend karyawan
Route::get('/karyawan-form-penilain',[FormKaryawanCont::class,'index_karyawan'])->name('be_index_karyawan');
Route::post('/karyawan-form-import',[FormKaryawanCont::class,'import_karyawan'])->name('be_import_karyawan');

//backend laporan

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
