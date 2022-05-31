<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use Validator;
use DataTables;
use Excel;

class FormKaryawanCont extends Controller
{
    public function index_karyawan(Request $request)
    {
        if ($request->ajax()) {
            $data   = Karyawan::all();
            return DataTables::of($data)
                    ->addColumn('option', function($data){
                        $actionBtn = '<a href="#" type="button" data-nama_kategori="'.$data->nama_kategori.'" data-kategori_id="'.$data->id.'" data-toggle="modal" data-target="#modaladd2" class="text-primary btn btn-sm btn-success"><i class="icon icon-plus"></i></a>';
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->addColumn('jabatan', function($data){
                        $jabatan = $data->jabatan->nama_jabatan;
                        return $jabatan;
                    })
            ->rawColumns(['option','jabatan'])
            ->make(true);
        }


        $karyawan = Karyawan::count();
        return view('page.karyawan',compact('karyawan'));
    }

    public function import_karyawan(Request $request)
    {
        $data = Excel::import(new KaryawanImport(), $request->file('file'));
        
        if(request()->ajax())
        {
        return Response()->json([
            $data,
            'success'=>'Karyawan Berhasil Ditambahkan Melalui file Excel'
        ]);
        }else {
            # code...
            return back()->with('success', 'Karyawan Imported Successfully.');
        }
    }
}
