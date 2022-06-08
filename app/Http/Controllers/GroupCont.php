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
                            $actionBtn =  '<a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-toggle="modal" data-target="#modaladd2" class="text-primary btn btn-sm btn-success"><i class="icon icon-plus"></i></a>';
                            $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-jenis_id="'.$data->jenis_id.'" data-toggle="modal" data-target="#modaledit" class="text-primary btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                            $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_group="'.$data->nama_group.'" data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
                            return $actionBtn;
                        })
                        
                ->rawColumns(['jenis','option'])
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

    public function karyawan_non_group()
    {
        $karyawan_group     = Karyawan::whereHas('group');
        $karyawan_non_group = Karyawan::all();
    }
}
