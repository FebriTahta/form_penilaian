<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Jenis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Validator;
use DataTables;

class FormKategoriCont extends Controller
{
    public function index_kategori(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data   = Kategori::with('jenis');
            return DataTables::of($data)
                    ->addColumn('option', function($data){
                        $actionBtn = '<a href="#" type="button" data-nama_kategori="'.$data->nama_kategori.'" data-kategori_id="'.$data->id.'" data-toggle="modal" data-target="#modaladd2" class="text-primary btn btn-sm btn-success"><i class="icon icon-plus"></i></a>';
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->addColumn('totalpoin', function($data){
                        $totalpoin = $data->poin->count();
                        return '<a href="#" class="text-success">'.$totalpoin.' Poin Penilaian</a>';
                    })
                    ->addColumn('jenispenilaian', function($data){
                        $jenis = $data->jenis->nama_jenis;
                        return $jenis;
                    })
            ->rawColumns(['option','totalpoin','jenispenilaian'])
            ->make(true);
        }
        $kategori   = Kategori::count();
        $jenis      = jenis::all();
        return view('page.kategori_penilaian',compact('kategori','jenis'));
    }

    public function store_kategori(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'jenis_id'      => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Response Gagal',
                'errors' => $validator->messages(),
            ]);

        }else {
        
            Kategori::updateOrCreate(
                [
                    'id'=>$request->id
                ],
                [
                    'nama_kategori' => $request->nama_kategori,
                    'jenis_id'      => $request->jenis_id,
                    'slug_kategori' => Str::slug($request->nama_kategori)
                ]
            );

            $kategori = Kategori::count();
        

            return response()->json(
                [
                'status'  => 200,
                'message' => 'Kategori has been Added',
                'total'   => $kategori
                ]
            );
        }
    }

    public function delete_kategori(Request $request)
    {
        $data = Kategori::find($request->id);
        if ($data->poin->count() > 0) {
            # code...
            return response()->json([
                'status' => 400,
                'message'  => 'Tidak dapat menghapus kategori yang memiliki poin. Hapus Poin pada kategori terlebih dahulu',
            ]);

        }else {
            # code...
            $data->delete();
            $kategori = Kategori::count();
            return response()->json(
                [
                'status'  => 200,
                'message' => 'Kategori has been Deleted',
                'total'   => $kategori
                ]
            );

        }
    }

    public function index_kategori_jenis(Request $request, $slug_jenis)
    {
        $jenis      = Jenis::where('slug_jenis',$slug_jenis)->first();
        $jenis_id   = $jenis->id;
        
        if ($request->ajax()) {
            # code...
            $data   = Kategori::where('jenis_id', $jenis_id);
            return DataTables::of($data)
                    ->addColumn('option', function($data){
                        $actionBtn = '<a href="#" type="button" data-nama_kategori="'.$data->nama_kategori.'" data-kategori_id="'.$data->id.'" data-toggle="modal" data-target="#modaladd2" class="text-primary btn btn-sm btn-success"><i class="icon icon-plus"></i></a>';
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_kategori="'.$data->nama_kategori.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->addColumn('totalpoin', function($data){
                        $totalpoin = $data->poin->count();
                        return '<a href="#" class="text-success">'.$totalpoin.' Poin Penilaian</a>';
                    })
                    ->addColumn('jenispenilaian', function($data){
                        $jenis = $data->jenis->nama_jenis;
                        return $jenis;
                    })
            ->rawColumns(['option','totalpoin','jenispenilaian'])
            ->make(true);
        }
        
        
        $kategori   = Kategori::where('jenis_id', $jenis_id)->count();
        return view('page.kategori_jenis',compact('kategori','jenis'));
    }
}
