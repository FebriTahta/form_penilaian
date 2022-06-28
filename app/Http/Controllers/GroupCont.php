<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Jenis;
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
                            $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                            $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                            return $actionBtn;
                        })
                        ->addColumn('anggota', function($data){
                            $anggota = $data->karyawan->count();
                            return $anggota.' Anggota';
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

    // public function data_karyawan2(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $group_id   = $request->id;
    //         $group      = Group::findOrFail($group_id);
    //         $data       = Karyawan::all();
    //         return DataTables::of($data)
    //                 ->addColumn('jabatan', function($data){
    //                     $jabatan = $data->jabatan->nama_jabatan;
    //                     return $jabatan;
    //                 })
    //                 ->addColumn('option', function($data) use ($group){
    //                     $actionBtn =
    //                     '<form id="formaddgroup">
    //                     <input type="hidden" name="group_id" value="'.$group->id.'"> 
    //                     <input type="hidden" name="karyawan_id" value="'.$data->id.'">
    //                     <input href="#" id="btnaddgroup" type="submit" class="text-primary btn btn-sm btn-success" value="Tambahkan Ke Group">
    //                     </form>';
    //                     return $actionBtn;
    //                 })
    //         ->rawColumns(['option','jabatan'])
    //         ->make(true);
    //     }
    // }

    public function add_karyawan_group(Request $request)
    {
        // return $request->group_id;
        $karyawan = Karyawan::findOrFail($request->karyawan_id);
        $group_id = $request->group_id;
        $group    = Group::findOrFail($group_id);
        $karyawan->group()->syncWithoutDetaching($group_id);
        return response()->json(
            [
            'status'  => 200,
            'message' => $karyawan->nama_karyawan.' Telah Ditambahkan Kedalam Group '.$group->nama_group,
            ]
        );
    }
}
