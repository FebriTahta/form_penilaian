<?php

namespace App\Http\Controllers;
use App\Models\Surveylembaga;
use App\Models\Detailsurveylembaga;
use App\Models\Cabang;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Jenis;
use App\Models\Provinsi;
use DB;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index_survey(Request $request)
    {
        
    }

    public function find_cabang(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Cabang::select('id','name')
                    ->where('id','LIKE','%' .$search . '%')
                    ->orWhere('name', 'LIKE', '%' .$search . '%')
                    ->get();
        }else{
            $data = Cabang::select('id','name')->get();
        }
        return response()->json($data);
    }

    public function find_kecamatan(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kecamatan::select('id','nama')
                    ->where('id','LIKE','%' .$search . '%')
                    ->orWhere('nama', 'LIKE', '%' .$search . '%')
                    ->get();
        }else{
            $data = Kecamatan::select('id','nama')->get();
        }
        return response()->json($data);
    }

    public function find_daerah($kecamatan_id)
    {
        $kecamatan  = Kecamatan::findOrFail($kecamatan_id);
        $kecamatan_nama = $kecamatan->nama;
        $kabupaten  = $kecamatan->kabupaten->nama;
        $provinsi   = $kecamatan->kabupaten->provinsi->nama;
        
        $data       = '<b>Kec : </b>'. strtoupper($kecamatan_nama) .'</br> <b>Kab/Kota : </b>'.strtoupper($kabupaten).'</br> <b>Provinsi : </b>'.strtoupper($provinsi);
        return response()->json($data);
    }

    public function find_kabupaten(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kabupaten::select('id','nama')
                    ->where('id','LIKE','%' .$search . '%')
                    ->orWhere('nama', 'LIKE', '%' .$search . '%')
                    ->get();
        }else{
            $data = Kabupaten::select('id','nama')->get();
        }
        return response()->json($data);
    }

    public function form_survey(Request $request)
    {
        $data1 = Surveylembaga::updateOrCreate(
            [
                'id'    =>  $request->id,
            ],
            [
                'nama_lembaga'  => $request->nama_lembaga,
                'cabang_id'     => $request->cabang_id,
                'alamat_lembaga'=> $request->alamat_lembaga,
            ]
        );

        if (strlen($request->tgl) == '1') {
            # code...
            $tanggal    = '0'.$request->tgl;
        }else {
            # code...
            $tanggal    = $request->tgl;
        }

        $tanggallahir   = $tanggal.'-'.$request->bln.'-'.$request->thn;
        $kab            = Kabupaten::find($request->tempat_lahir_santri);
        $kabupaten      = $kab->nama;

        $data2 = Detailsurveylembaga::updateOrCreate(
            [
                'id'    =>  $request->id,
            ],
            [
                'surveylembaga_id'  => $data1->id,
                'nama_santri'       => $request->nama_santri,
                'tempatlahir_santri'=> $kabupaten,
                'tanggallahir_santri' => $tanggallahir,
                'nama_ayah'         => $request->nama_ayah,
                'hp_ayah'           => $request->hp_ayah,
                'nama_ibu'          => $request->nama_ibu,
                'hp_ibu'            => $request->hp_ibu
            ]
        );

        $jenis = Jenis::where('slug_jenis',$request->slug_jenis)->first();
        return view('fe.form_sukses',compact('jenis'));
        
    }

    public function find_nama_cabang(Request $request, $cabang_id)
    {
        $cabang = Cabang::find($cabang_id);
        $data   = $cabang->name;
        return response()->json($data);
    }
}
