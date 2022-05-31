<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormPenilaianCont;
use App\Http\Controllers\FormJenisCont;
use App\Http\Controllers\FormKategoriCont;
use App\Http\Controllers\FormPoinCont;
use App\Http\Controllers\FormKaryawanCont;

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
    return view('page.dashboard');
});


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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
