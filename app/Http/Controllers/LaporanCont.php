<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use App\Models\Group;
use App\Models\Mengisi;
use App\Models\Kategori;
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
                                                    ->whereMonth('tanggal',$bln)
                                                    ->where('karyawan_id', $data->karyawan->id)->count().' Pengisian Form & '. $berhalangan .' Hari Berhalangan';
                            }else {
                                # code...
                                return $pengisian = Mengisi::where('jenis_id', $jenis->id)
                                                    ->whereMonth('tanggal',$bln)
                                                    ->where('karyawan_id', $data->karyawan->id)->count().' Pengisian Form';
                            }
                            
                        })
                        ->addColumn('jabatan', function($data){
                            return $data->karyawan->jabatan->nama_jabatan;
                        })
                        ->addColumn('score', function($data) use ($jenis,$bln,$thn) {
                            $score          = Mengisi::where('jenis_id', $jenis->id)
                                                    ->whereMonth('tanggal',$bln)
                                                    ->where('karyawan_id', $data->karyawan->id)
                                                    ->sum('total');
                            $pengisian      = Mengisi::where('jenis_id', $jenis->id)
                                                    ->whereMonth('tanggal',$bln)
                                                    ->where('karyawan_id', $data->karyawan->id)
                                                    ->count();
                            $berhalangan    = Mengisi::where('jenis_id', $jenis->id)
                                                    ->whereMonth('tanggal',$bln)
                                                    ->where('karyawan_id', $data->karyawan->id)
                                                    ->where('keterangan','berhalangan')
                                                    ->count();
                            
                            if ($berhalangan !== 0) {
                                # code...
                                $terhitung  = $pengisian - $berhalangan;
                            }else {
                                # code...
                                $terhitung  = $pengisian;
                            }

                            if ($score !== 0) {
                                # code...
                                $total          = $score / $terhitung;
                                $v_val          = $total * 5;
                                
                                if ($v_val > 90) {
                                    # code...
                                    $value          = '<span style="float:left"> '.$score .' Poin '.'& Nilai : '.round($v_val) .'</span>' .'<span style="float:right; color:green;" class="text-success;">( ISTIMEWA )</span>';

                                }elseif($v_val > 80 && $v_val < 90)
                                {
                                    # code...
                                    $value          = '<span style="float:left"> '.$score .' Poin '.'& Nilai : '.round($v_val) .'</span>' .'<span style="float:right" class="text-primary">( SANGAT BAIK)</span>';

                                }elseif($v_val > 70 && $v_val < 79)
                                {
                                    # code...
                                    $value          = '<span style="float:left"> '.$score .' Poin '.'& Nilai : '.round($v_val) .'</span>' .'<span style="float:right" class="text-info">( BAIK )</span>';

                                }elseif($v_val > 60 && $v_val < 69)
                                {
                                    # code...
                                    $value          = '<span style="float:left"> '.$score .' Poin '.'& Nilai : '.round($v_val) .'</span>' .'<span style="float:right" class="text-warning">( CUKUP )</span>';

                                }else {
                                    # code...
                                    $value          = '<span style="float:left"> '.$score .' Poin '.'& Nilai : '.round($v_val) .'</span>' .'<span style="float:right" class="text-danger">( KURANG )</span>';

                                }

                                return $value;
                            }else {
                                # code...
                                return '-';
                            }

                            
                            
                        })
                        ->addColumn('status', function($data) use ($jenis,$bln,$thn){
                            $jumHari   = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
                            $pengisian = Mengisi::where('jenis_id', $jenis->id)
                                        ->whereMonth('tanggal',$bln)
                                        ->where('karyawan_id', $data->karyawan->id)->count();
                            $selisih   = $jumHari - $pengisian;
                            // LOGIC
                            if ($selisih > 0) {
                                # code...
                                $jumHari   = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
                                $pengisians = Mengisi::where('jenis_id', $jenis->id)
                                            ->whereMonth('tanggal',$bln)
                                            ->where('karyawan_id', $data->karyawan->id)
                                            ->orderBy('tanggal')->get();
                                
                                $repeater = [];
                                $data_tgl = [];
                        
                                foreach ($pengisians as $key => $value) {
                                    # code...
                                    $format_tanggal = Carbon::parse($value->tanggal)->format('d');
                                    if ($format_tanggal < 10) {
                                        # code...
                                        $data_tgl[] = substr($format_tanggal,-1);
                                    }else {
                                        # code...
                                        $data_tgl[] = $format_tanggal;
                                    }
                                     
                                }
                                for ($i=0; $i < $jumHari; $i++) { 
                                    # code...
                                    $repeater[] = strval($i+1);
                                }
                                $value = array_diff($repeater,$data_tgl);
                        
                                return '<a href="#" style="color:red" data-toggle="modal" data-target="#modal_kurang_mengisi" data-nama="'.$data->karyawan->nama_karyawan.'"
                                data-jenis="'.$jenis->nama_jenis.'" data-tanggal_kosong="'.implode(', ',$value).'"
                                >
                                Pengisian kurang '.$selisih.' Hari</a>';
                            }else {
                                # code...
                                return 'Taat/Patuh';
                            }
                        })
                        
                ->rawColumns(['option','karyawan','jabatan','score','pengisian','status'])
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
                            ->sum('total'). ' Poin ';
                        })
                        ->addColumn('status', function($data) use ($jenis){
                            return 'Keseluruhan Bulan';
                        })
                        
                ->rawColumns(['option','karyawan','jabatan','score','pengisian','status'])
                ->make(true);
            }
        }


        return view('page.laporan_detail2',compact('laporan','total_laporan','jenis'));
    }

    public function belum_mengisi()
    {
        // TES
        $jumHari   = cal_days_in_month(CAL_GREGORIAN, 06, 2020);
        $pengisian = Mengisi::where('jenis_id', $jenis_id)
                    ->whereMonth('tanggal',06)
                    ->where('karyawan_id', 54)
                    ->orderBy('tanggal')->get();
        
        $repeater = [];
        $data_tgl = [];

        foreach ($pengisian as $key => $value) {
            # code...
            $format_tanggal = Carbon::parse($value->tanggal)->format('d');
            if ($format_tanggal < 10) {
                # code...
                $data_tgl[] = substr($format_tanggal,-1);
            }else {
                # code...
                $data_tgl[] = $format_tanggal;
            }
             
        }

        for ($i=0; $i < $jumHari; $i++) { 
            # code...
            $repeater[] = strval($i+1);
        }


        $value = array_diff($repeater,$data_tgl);

        return implode(' ',$value);
        // END TES
    }

    public function laporan_group(Request $request,$slug_jenis)
    {
        $jenis = Jenis::where('slug_jenis',$slug_jenis)->first();

        if ($request->ajax()) {
            if(!empty($request->bulan))
            {
                # code...
                $thn = substr($request->bulan,0,4);
                $bln = substr($request->bulan,5,2);

                $data  = Group::where('jenis_id',$jenis->id);
                        return DataTables::of($data)
                        ->addColumn('score', function($data) use ($jenis,$bln,$thn) {

                            $karyawan       = $data->karyawan;
                            $score[]=0;
                            $total=0;
                            foreach ($karyawan as $key => $kar) {
                                # code...
                                $score[$key]            = Mengisi::where('jenis_id', $jenis->id)
                                                        ->whereMonth('tanggal',$bln)
                                                        ->where('karyawan_id', $kar->id)
                                                        ->sum('total');
                                $total                  = array_sum($score);
                            }
                            $total_karyawan = $data->karyawan->count();
                            $hasil = $total / $total_karyawan;
                            $jumHari   = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
                            $kategori = Kategori::where('jenis_id',$jenis->id)->get();

                            $max = 0;
                            $fin = [];
                            $temp= [];
                            foreach ($kategori as $key => $value) {
                                # code...
                                foreach ($value->poin as $key => $find_max_poin) {
                                    # code...
                                    $fin[] = $find_max_poin->besar_poin;
                                }
                                $temp[] = max($fin);
                            }
                            return $temp;
                        })
                        
                ->rawColumns(['score'])
                ->make(true);
            }else {
                # code...
                
            }
            
        }
        return view('page.laporan_group',compact('jenis'));
    }
}
