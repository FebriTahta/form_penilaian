<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
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
        return view('page.laporan_detail');
    }
}
