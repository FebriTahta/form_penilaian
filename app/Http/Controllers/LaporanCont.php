<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use App\Models\Group;
use App\Models\Mengisi;
use App\Models\Poin;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\Penilaian;
use App\Exports\LaporanAmalanExport;
use Illuminate\Http\Request;
use DataTables;
use Excel;
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
                        ->addColumn('maxscore', function($data) use ($jenis,$bln,$thn) {
                            $jumHari   = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
                            $kategori = Kategori::where('jenis_id',$jenis->id)->get();
                            $max = 0;
                            $fin = [];
                            
                            foreach ($kategori as $key => $value) {
                                # code...
                                $fin[] = $value->poin->max('besar_poin');
                                $max   = array_sum($fin).' score * '.$jumHari.' Hari';
                            }
                            settype($max, "integer"); 
                            $maxscore = $max * $jumHari;
                            return 'Max Score 1 Bulan - '.$maxscore;
                        })
                        ->addColumn('finalscore', function($data) use ($jenis,$bln,$thn) {

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
                            return round($hasil);
                        })

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
                            return implode('<br>',$score);
                        })

                        ->addColumn('anggota', function($data) use ($jenis,$bln,$thn) {

                            $karyawan       = $data->karyawan;
                            $score[]=0;
                            $total=0;
                            $anggota = [];
                            foreach ($karyawan as $key => $kar) {
                                # code...
                                $score[$key]            = Mengisi::where('jenis_id', $jenis->id)
                                                        ->whereMonth('tanggal',$bln)
                                                        ->where('karyawan_id', $kar->id)
                                                        ->sum('total');
                                $total                  = array_sum($score);
                                $anggota[]              = '<a data-toggle="modal" data-target="#modallaporan" 
                                data-karyawan_id="'.$kar->id.'" data-jenis_id="'.$jenis->id.'" data-nama_jenis="'.$jenis->nama_jenis.'" data-bulan="'.$bln.'" data-tahun ="'.$thn.'"
                                data-nama_karyawan="'.$kar->nama_karyawan.'" 
                                href="#">'.$kar->nama_karyawan.'</a>';
                            }
                            // href="/export-laporan-amalan/'.$kar->id.'/'.$jenis->id.'/'.$bln.'/'.$thn.'">'.$kar->nama_karyawan.'</a>';
                            $total_karyawan = $data->karyawan->count();
                            $hasil = $total / $total_karyawan;
                            return implode('<br> * ',$anggota);
                        })
                        
                ->rawColumns(['finalscore','maxscore','anggota','score'])
                ->make(true);
            }else {
                # code...
                
            }
            
        }
        return view('page.laporan_group',compact('jenis'));
    }

    public function export_laporan_amalan(Request $request , $karyawan_id, $jenis_id, $bulan, $tahun)
    {
        $karyawan   = Karyawan::where('id',$karyawan_id)->first();
        $jenis      = Jenis::where('id', $jenis_id)->first();
        return Excel::download(new LaporanAmalanExport($karyawan,$jenis,$bulan,$tahun), $jenis->nama_jenis.' - '.$karyawan->nama_karyawan.' - bulan '.$bulan.'.xlsx');
    }
}
