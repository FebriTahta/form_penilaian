<?php

namespace App\Exports;
use App\Models\Karyawan;
use App\Models\Jenis;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanAmalanExport implements ShouldAutoSize,FromView
{
    public function __construct($karyawan,$jenis,$bulan)
    {
        $this->karyawan=$karyawan;
        $this->jenis=$jenis;
        $this->bulan=$bulan;
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
        $data_karyawan = $this->karyawan;
        $data_jenis    = $this->jenis;
        $data_bulan    = $this->bulan;

        return view('cetak.laporan_amalan',compact('data_karyawan','data_jenis','data_bulan'));
    }
}
