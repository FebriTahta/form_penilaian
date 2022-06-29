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
                            return '<a href="#" class="text-primary" data-toggle="modal" data-target="#modalanggota" data-id="'.$data->id.'">'.$data->karyawan->count().' Anggota.</a>'; 
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

    public function remove_group(Request $request)
    {
        $group = Group::where('id',$request->id)->first();
        $group_name = $group->nama_group;
        
        if ($group->karyawan->count() > 0) {
            # code...
            $total = Group::count();
            return response()->json(
                [
                'status'  => 400,
                'message' => 'Terdapat Anggota Karyawan Yang Berada Pada Group. Keluarkan Dulu Anggota Pada Group Sebelum Menghapus Group',
                'total'   => $total
                ]
            );
        }else {
            # code...
            $group->delete();
            $total = Group::count();
            return response()->json(
                [
                'status'  => 200,
                'message' => 'Group ' .$group_name. ' has been Deleted',
                'total'   => $total
                ]
            );
        }
        
    }

    public function data_anggota(Request $request, $group_id)
    {
        if ($request->ajax()) {

            $group      = Group::where('id', $group_id)->first();
            
            $data       = $group->karyawan;
            return        DataTables::of($data)

                         ->addColumn('option', function ($data) use ($group_id) {
                             return '<button data-group_id="'.$group_id.'" data-karyawan_id="'.$data->id.'" class="tutup btn btn-sm btn-danger" type="button" data-dismiss="modal" data-toggle="modal" data-target="#modalkick">Keluarkan Group</button>';
                         })
                         ->addColumn('anggota', function($data){
                             return $data->nama_karyawan;
                         })
            ->rawColumns(['anggota','option',])
            ->make(true);

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

    public function kick_karyawan(Request $request)
    {
        $karyawan = Karyawan::findOrFail($request->karyawan_id);
        $group_id = $request->group_id;
        $group    = Group::findOrFail($group_id);
        
        $exist    = GroupKaryawan::where('group_id', $group_id)->where('karyawan_id', $karyawan->id)->first();
        if($exist == null)
        {
            return response()->json(
                [
                'status'  => 400,
                'message' => 'Karyawan Tidak berada pada Group Ini',
                ]
            );

        }else{
            $group->karyawan()->detach($request->karyawan_id);
            return response()->json(
                [
                'status'  => 200,
                'message' => $karyawan->nama_karyawan.' Telah Dikeluarkan Dari Group '.$group->nama_group,
                ]
            );
        }
    }
}
