<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormPenilaianCont;
use App\Http\Controllers\FormJenisCont;
use App\Http\Controllers\FormKategoriCont;
use App\Http\Controllers\FormPoinCont;
use App\Http\Controllers\LaporanCont;
use App\Http\Controllers\GroupCont;
use App\Http\Controllers\FormKaryawanCont;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\whatsappController;
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
    // $poin = Poin::count();
    // $kategori = Kategori::count();
    // $jenis = Jenis::count();
    // $karyawan = Karyawan::count();
    // return view('page.dashboard',compact('poin','kategori','jenis','karyawan'));

    return redirect('/login');
});
Auth::routes();

Route::get('/find-nama-karyawan',[FormJenisCont::class,'find_nama_karyawan'])->name('find_karyawan');
//FrontEnd Form Penilaian
Route::get('/form/{slug_jenis}',[FormJenisCont::class,'form_penilaian']);
    
Route::post('/form-penilaian',[FormJenisCont::class,'form_penilaian_karyawan'])->name('form_penilaian');
Route::post('/submit-form-penilaian',[FormJenisCont::class,'submit_form'])->name('submit-form-penilaian');
Route::post('/submit-form-berhalangan',[FormJenisCont::class,'submit_berhalangan'])->name('submit-form-berhalangan');


// SURVEY DB 2 FE
Route::get('/survey-lembaga',[SurveyController::class,'index_survey'])->name('fe_index_survey');
Route::post('/form-survey',[SurveyController::class,'form_survey'])->name('form_survey');
Route::get('/tes123',[whatsappController::class,'tes'])->name('tes123');

Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {

    Route::get('/find-cabang',[SurveyController::class,'find_cabang'])->name('find_cabang');
    Route::get('/find-kecamatan',[SurveyController::class,'find_kecamatan'])->name('find_kecamatan');
    Route::get('/find-daerah/{kecamatan_id}',[SurveyController::class,'find_daerah'])->name('find_daerah');
    Route::get('/find-kabupaten',[SurveyController::class,'find_kabupaten'])->name('find_kabupaten');
    Route::get('/find-nama-group',[FormJenisCont::class,'find_nama_group'])->name('find_group');
    Route::get('/find-nama-cabang/{cabang_id}',[SurveyController::class,'find_nama_cabang'])->name('find_nama_cabang');
    
    
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
    Route::post('/karyawan-form-add',[FormKaryawanCont::class,'add_karyawan'])->name('be_store_karyawan');
    Route::post('/karyawan-form-update',[FormKaryawanCont::class,'update_karyawan'])->name('be_update_karyawan');
    Route::post('/karyawan-form-delete',[FormKaryawanCont::class,'delete_karyawan'])->name('be_delete_karyawan');
    
    //backend laporan
    Route::get('/karyawan-form-laporan',[LaporanCont::class,'laporan_detail'])->name('be_laporan_detail');
    Route::get('/karyawan-form-laporan/{slug_jenis}',[LaporanCont::class,'laporan_detail2']);
    Route::get('/karyawan-form-laporan-group/{slug_jenis}',[LaporanCont::class,'laporan_group']);
    
    
    //backend group
    Route::get('/group-karyawan',[GroupCont::class,'index_group'])->name('be_index_group');
    Route::post('/group-karyawan-store',[GroupCont::class,'store_group'])->name('be_store_group');
    Route::get('/group-list-karyawan',[GroupCont::class,'data_karyawan2'])->name('be_data_karyawan2');
    Route::post('/group-remove',[GroupCont::class,'remove_group'])->name('be_remove_group');
    Route::get('/group-list-anggota-group/{group_id}',[GroupCont::class,'data_anggota']);
    Route::post('/group-add-karyawan',[GroupCont::class,'add_karyawan_group'])->name('be_store_karyawan_group');
    Route::post('/group-kick-karyawan-from-group',[GroupCont::class,'kick_karyawan'])->name('be_kick_karyawan_group');

    //backend daerah indonesia
    Route::get('/provinsi',[DaerahController::class,'index_provinsi'])->name('be.provinsi.page');
    Route::post('/provinsi-import',[DaerahController::class,'import_provinsi'])->name('be.provinsi.import');
    Route::get('/kabupaten',[DaerahController::class,'index_kabupaten'])->name('be.kabupaten.page');
    Route::post('/kabupaten-import',[DaerahController::class,'import_kabupaten'])->name('be.kabupaten.import');
    Route::get('/kecamatan',[DaerahController::class,'index_kecamatan'])->name('be.kecamatan.page');
    Route::post('/kecamatan-import',[DaerahController::class,'import_kecamatan'])->name('be.kecamatan.import');
    Route::get('/kelurahan',[DaerahController::class,'index_kelurahan'])->name('be.kelurahan.page');
    Route::post('/kelurahan-import',[DaerahController::class,'import_kelurahan'])->name('be.kelurahan.import');


    
    //backend export laporan amalan harian
    Route::get('/export-laporan-amalan/{karyawan_id}/{jenis}/{bulan}/{tahun}',[LaporanCont::class,'export_laporan_amalan']);
    Route::get('/export-laporan-amalan-group/{jenis_id}/{month}',[LaporanCont::class,'export_laporan_amalan_group']);
    
    Route::get('/tes', function(){
        $penilaian = App\Models\Penilaian::where('karyawan_id',63)
                                         ->where('jenis_id',1)
                                         ->where('kategori_id',1)
                                         ->whereDate('tanggal','2022-06-08')
                                         ->first();
        return $penilaian->nilai;
    });
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');    
});
Route::get('/nama_karyawan_from_id/{user_id}',[FormKaryawanCont::class,'nama_karyawan_from_id']);
