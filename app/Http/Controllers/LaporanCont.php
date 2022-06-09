<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use App\Models\Mengisi;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;

class LaporanCont extends Controller
{
    public function laporan_detail(Request $request)
    {
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
            if(!empty($request->bulan))
            {
                # code...
                $thn = substr($request->bulan,0,4);
                $bln = substr($request->bulan,5,2);

                $data   = Mengisi::where('jenis_id', $jenis->id)
                          ->whereMonth('tanggal',$bln)
                          ->with('karyawan')
                          ->distinct()
                          ->get(['karyawan_id']);
                        return DataTables::of($data)
                        
                        ->addColumn('option', function($data){
                            return '-';
                        })
                        ->addColumn('karyawan', function($data){
                            return $data->karyawan->nama_karyawan;
                        })
                        ->addColumn('pengisian', function($data) use ($jenis, $bln){
                            $berhalangan = Mengisi::where('jenis_id', $jenis->id)
                                         ->whereMonth('tanggal',$bln)
                                         ->where('karyawan_id', $data->karyawan->id)->where('keterangan','berhalangan')->count();

                            if ($berhalangan > 0) {
                                # code...
                                return $pengisian = Mengisi::where('jenis_id', $jenis->id)
                                ->where('karyawan_id', $data->karyawan->id)->count().' Pengisian Form & '. $berhalangan .' Hari Berhalangan';
                            }else {
                                # code...
                                return $pengisian = Mengisi::where('jenis_id', $jenis->id)
                                ->where('karyawan_id', $data->karyawan->id)->count().' Pengisian Form';
                            }
                            
                        })
                        ->addColumn('jabatan', function($data){
                            return $data->karyawan->jabatan->nama_jabatan;
                        })
                        ->addColumn('score', function($data) use ($jenis,$bln) {
                            return $score     = Mengisi::where('jenis_id', $jenis->id)
                            ->whereMonth('tanggal',$bln)
                            ->where('karyawan_id', $data->karyawan->id)
                            ->sum('total');
                        })
                        
                ->rawColumns(['option','karyawan','jabatan','score','pengisian'])
                ->make(true);
            }else {
                # code...
                $data   = Mengisi::where('jenis_id', $jenis->id)
                          ->with('karyawan')
                          ->distinct()
                          ->get(['karyawan_id']);
                        return DataTables::of($data)
                        
                        ->addColumn('option', function($data){
                            return '-';
                        })
                        ->addColumn('karyawan', function($data){
                            return $data->karyawan->nama_karyawan;
                        })
                        ->addColumn('pengisian', function($data) use ($jenis) {
                            $berhalangan = Mengisi::where('jenis_id', $jenis->id)
                                         ->where('karyawan_id', $data->karyawan->id)
                                         ->where('keterangan','berhalangan')->count();

                            if ($berhalangan > 0) {
                                # code...
                                return $pengisian = Mengisi::where('jenis_id', $jenis->id)
                                ->where('karyawan_id', $data->karyawan->id)->count().' Pengisian Form & '. $berhalangan .' Hari Berhalangan';
                            }else {
                                # code...
                                return $pengisian = Mengisi::where('jenis_id', $jenis->id)
                                ->where('karyawan_id', $data->karyawan->id)->count().' Pengisian Form';
                            }
                        })
                        ->addColumn('jabatan', function($data){
                            return $data->karyawan->jabatan->nama_jabatan;
                        })
                        ->addColumn('score', function($data) use ($jenis) {
                            return $score     = Mengisi::where('jenis_id', $jenis->id)
                            ->where('karyawan_id', $data->karyawan->id)
                            ->sum('total');
                        })
                        
                ->rawColumns(['option','karyawan','jabatan','score','pengisian'])
                ->make(true);
            }
            
        }


        return view('page.laporan_detail2',compact('laporan','total_laporan','jenis'));
    }
}
