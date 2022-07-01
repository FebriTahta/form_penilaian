<?php

namespace App\Exports;
use App\Models\Jenis;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanGroup implements  ShouldAutoSize,FromView
{
    public function __construct($jenis,$bulan,$tahun,$month)
    {
        $this->jenis=$jenis;
        $this->bulan=$bulan;
        $this->tahun=$tahun;
        $this->month=$month;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     //
    // }

    public function view(): View
    {
        // $data_jenis    = $this->jenis;
        // $bulan         = $this->bulan;
        // $data_tahun    = $this->tahun;
        // $data_bulan    = 0;
        // $data_month    = $this->month;

        // if ($bulan == '01') {
        //     # code...
        //     $data_bulan = 'Januari';
        // }elseif($bulan == '02'){
        //     # code...
        //     $data_bulan = 'Februari';
        // }elseif($bulan == '03'){
        //     # code...
        //     $data_bulan = 'Maret';
        // }elseif($bulan == '04'){
        //     # code...
        //     $data_bulan = 'April';
        // }elseif($bulan == '05'){
        //     # code...
        //     $data_bulan = 'Mei';
        // }elseif($bulan == '06'){
        //     # code...
        //     $data_bulan = 'Juni';
        // }elseif($bulan == '07'){
        //     # code...
        //     $data_bulan = 'Juli';
        // }elseif($bulan == '08'){
        //     # code...
        //     $data_bulan = 'Agustus';
        // }elseif($bulan == '09'){
        //     # code...
        //     $data_bulan = 'September';
        // }elseif($bulan == '10'){
        //     # code...
        //     $data_bulan = 'Oktober';
        // }elseif($bulan == '11'){
        //     # code...
        //     $data_bulan = 'November';
        // }elseif($bulan == '12'){
        //     # code...
        //     $data_bulan = 'Desember';
        // }

        return view('cetak.laporan_amalan_group');
    }
}
