<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Jenis;
use App\Models\GroupKaryawan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class GroupCont extends Controller
{
    public function index_group(Request $request)
    {
        if ($request->ajax()) {
            $data   = Group::with('jenis')->get();
                return DataTables::of($data)
                        ->addColumn('jenis', function ($data) {
                            return $data->jenis->nama_jenis;
                        })

                        ->addColumn('option', function ($data) {
                            $actionBtn = ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                            $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('anggota', function($data){
                            return '<a href="#" class="text-primary" data-toggle="modal" data-target="#modalanggota" data-id="$data->id">'.$data->karyawan->count().' Anggota.</a>'; 
                        })
                ->rawColumns(['jenis','option','anggota'])
                ->make(true);
        }

        
        $group = Group::count();
        $jenis = Jenis::all();
        return view('page.group',compact('group','jenis'));
    }

    public function store_group(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_group'    => 'required',
            'jenis_id'      => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Response Gagal',
                'errors' => $validator->messages(),
            ]);

        }else {
        
            Group::updateOrCreate(
                [
                    'id'=>$request->id
                ],
                [
                    'nama_group' => $request->nama_group,
                    'jenis_id'      => $request->jenis_id,
                ]
            );

            $group = Group::count();
        

            return response()->json(
                [
                'status'  => 200,
                'message' => 'Group has been Added',
                'total'   => $group
                ]
            );
        }
    }

    public function data_anggota(Request $request, $group_id)
    {
        if ($request->ajax()) {

            $group_id   = $group_id;   
            $group      = Group::find($group_id);
            // $data = Karyawan::with('group')->whereHas('group', function($q) use ($group){
            //     $q->where('nama_group',"=",$group->nama_group);
            // })->get();

            $data = $group;
           if ($data !== null) {
                # code...
                return response()->json(
                    [
                    'status'  => 200,
                    'message' => $data,
                    ]
                );
           }else{
                # code...
                return response()->json(
                    [
                    'status'  => 400,
                    'message' => 'query error',
                    ]
                );
           }
        }
    }

    public function add_karyawan_group(Request $request)
    {
       
        
        $karyawan = Karyawan::findOrFail($request->select_karyawan);
        $group_id = $request->select_group;
        $group    = Group::findOrFail($group_id);
        
        $exist    = GroupKaryawan::where('karyawan_id', $karyawan->id)->first();
        if($exist !== null)
        {
            
            return response()->json(
                [
                'status'  => 400,
                'message' => 'Karyawan Sudah Terdaftar Pada Group Lain',
                ]
            );

        }else{
            $group->karyawan()->syncWithoutDetaching($karyawan->id);
            return response()->json(
                [
                'status'  => 200,
                'message' => $karyawan->nama_karyawan.' Telah Ditambahkan Kedalam Group '.$group->nama_group,
                ]
            );
        }
    }
}
