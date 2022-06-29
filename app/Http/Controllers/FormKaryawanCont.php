<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Mengisi;
use App\Models\Penilaian;
use App\Models\GroupKaryawan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use Validator;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Excel;

class FormKaryawanCont extends Controller
{
    public function index_karyawan(Request $request)
    {
        if ($request->ajax()) {
            $data   = Karyawan::all();
            return DataTables::of($data)
                    ->addColumn('option', function($data){
                        $actionBtn = '<a href="#" type="button" data-id="'.$data->id.'" data-nama_karyawan="'.$data->nama_karyawan.'" 
                        data-jabatan_id="'.$data->jabatan_id.'" data-telp_karyawan="'.$data->telp_karyawan.'" data-tempatlahir_karyawan="'.$data->tempatlahir_karyawan.'"
                        data-tanggallahir_karyawan="'.$data->tanggallahir_karyawan.'" data-alamat_karyawan="'.$data->alamat_karyawan.'" data-jenkel="'.$data->jenkel.'"
                        data-toggle="modal" data-target="#modaledit" class="text-danger btn btn-sm btn-primary"><i class="icon icon-pencil"></i></a>';
                        
                        
                        $actionBtn .= ' <a href="#" type="button" data-id="'.$data->id.'" data-nama_karyawan="'.$data->nama_karyawan.'" 
                        data-jabatan_id="'.$data->jabatan_id.'" data-telp_karyawan="'.$data->telp_karyawan.'" data-tempatlahir_karyawan="'.$data->tempatlahir_karyawan.'"
                        data-tanggallahir_karyawan="'.$data->tanggallahir_karyawan.'" data-alamat_karyawan="'.$data->alamat_karyawan.'" data-jenkel="'.$data->jenkel.'"
                        data-toggle="modal" data-target="#modaldel" class="text-danger btn btn-sm btn-danger"><i class="icon icon-trash"></i></a>';
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
        $jabatan  = Jabatan::all();
        return view('page.karyawan',compact('karyawan','jabatan'));
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

    public function add_karyawan(Request $request)
    {
        $user = User::updateOrCreate(
            [
                'id' => $request->id_user
            ],
            [
                'name' => $request->nama_karyawan,
                'pass' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin')
            ]
        );

        $karyawan = Karyawan::updateOrCreate(
            [
                'id' => $request->id_karyawan
            ],
            [
                'nama_karyawan' => $request->nama_karyawan,
                'user_id'       => $user->id,
                'jabatan_id'    => $request->jabatan_id,
                'slug_karyawan' => Str::slug($request->nama_karyawan),
                'telp_karyawan' => $request->telp_karyawan,
                'tempatlahir_karyawan' => $request->tempatlahir_karyawan,
                'tanggallahir_karyawan'=> $request->tanggallahir_karyawan,
                'alamat_karyawan'      => $request->alamat_karyawan,
                'jenkel'               => $request->jenkel,
            ]
        );

        $total = Karyawan::count();
        return response()->json(
            [
            'status'  => 200,
            'message' => $request->nama_karyawan.' Berhasil Ditambahkan Sebagai Karyawan Baru',
            'total'   => $total
            ]
        );
    }

    public function update_karyawan(Request $request)
    {
        $karyawan_id = $request->id;

        $karyawan = Karyawan::where('id', $karyawan_id)->first();
        $user     = User::where('name', $karyawan->nama_karyawan)->first();

        $user->update(
            [
                'name' => $request->nama_karyawan,
                'pass' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('admin')
            ]
        );
        
        $karyawan->update(
            [
                'nama_karyawan' => $request->nama_karyawan,
                'user_id'       => $user->id,
                'jabatan_id'    => $request->jabatan_id,
                'slug_karyawan' => Str::slug($request->nama_karyawan),
                'telp_karyawan' => $request->telp_karyawan,
                'tempatlahir_karyawan' => $request->tempatlahir_karyawan,
                'tanggallahir_karyawan'=> $request->tanggallahir_karyawan,
                'alamat_karyawan'      => $request->alamat_karyawan,
                'jenkel'               => $request->jenkel,
            ]
        );

        return response()->json(
            [
            'status'  => 200,
            'message' => 'Data '.$karyawan->nama_karyawan. ' Berhasil Diperbarui',
            ]
        );
    }

    public function delete_karyawan(Request $request)
    {
        $karyawan = Karyawan::where('id', $request->id)->first();
        $groupkaryawan = GroupKaryawan::where('karyawan_id', $request->id)->first();

        if ($groupkaryawan !== null) {
            # code...

            $mengisi = Mengisi::where('karyawan_id',$request->id)->get();
            if ($mengisi->count() > 0) {
                # code...
                Mengisi::where('karyawan_id',$request->id)->delete();
                Penilaian::where('karyawan_id', $request->id)->delete();
            }

            $karyawan->group()->detach();
            $karyawan->delete();
            return response()->json(
                [
                'status'  => 200,
                'message' => 'Karyawan Berhasil Dihapus Dan Dikeluarkan Pada Group',
                ]
            );

        }else {
            # code...

            $mengisi = Mengisi::where('karyawan_id',$request->id)->get();
            if ($mengisi->count() > 0) {
                # code...
                Mengisi::where('karyawan_id',$request->id)->delete();
                Penilaian::where('karyawan_id', $request->id)->delete();
            }

            $karyawan->delete();
            return response()->json(
                [
                'status'  => 200,
                'message' => 'Karyawan Berhasil Dihapus',
                ]
            );
        }
    }
}
