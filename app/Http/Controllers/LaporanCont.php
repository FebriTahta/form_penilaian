<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use App\Models\Mengisi;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use DataTables;

class LaporanCont extends Controller
{
    public function laporan_detail(Request $request)
    {
        if ($request->ajax()) {
            $data   = Jenis::all();
            return DataTables::of($data)
                    ->addColumn('option', function($data){
                        // $actionBtn = '<a href="#" type="button" data-nama_kategori="'.$data->nama_kategori.'" data-kategori_id="'.$data->id.'" data-toggle="modal" data-target="#modaladd2" class="text-primary btn btn-sm btn-success"><i class="icon icon-plus"></i></a>';
                        // $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                        // $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                        // return $actionBtn;
                    })
                    // ->addColumn('jabatan', function($data){
                    //     $jabatan = $data->jabatan->nama_jabatan;
                    //     return $jabatan;
                    // })
            ->rawColumns(['option'])
            ->make(true);
        }
        $total_jenis = Jenis::count();
        $jenis       = Jenis::all();
        return view('page.laporan_detail',compact('total_jenis','jenis'));
    }

    public function laporan_detail2(Request $request, $slug_jenis)
    {
        

        $jenis   = Jenis::where('slug_jenis',$slug_jenis)->first();
        $laporan = Mengisi::where('jenis_id', $jenis->id)->get();
        $total_laporan = $laporan->count();

        if ($request->ajax()) {
            $data   = Mengisi::where('jenis_id', $jenis->id)->with('karyawan')->get();
            return DataTables::of($data)
                    ->addColumn('option', function($data){
                        // $actionBtn = '<a href="#" type="button" data-nama_kategori="'.$data->nama_kategori.'" data-kategori_id="'.$data->id.'" data-toggle="modal" data-target="#modaladd2" class="text-primary btn btn-sm btn-success"><i class="icon icon-plus"></i></a>';
                        // $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                        // $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                        // return $actionBtn;
                    })
                    ->addColumn('karyawan', function($data){
                        return $data->karyawan->nama_karyawan;
                    })
                    ->addColumn('jabatan', function($data){
                        return $data->karyawan->jabatan->nama_jabatan;
                    })
                    ->addColumn('score', function($data){
                        return $data->total;
                    })
                    
            ->rawColumns(['option','karyawan','jabatan','score'])
            ->make(true);
        }


        return view('page.laporan_detail2',compact('laporan','total_laporan','jenis'));
    }
}
