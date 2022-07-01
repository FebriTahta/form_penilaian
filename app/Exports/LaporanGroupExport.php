<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanGroupExport implements ShouldAutoSize,FromView
{
    public function __construct($month,$jenis,$bulan,$tahun)
    {
        $this->month=$month;
        $this->jenis=$jenis;
        $this->bulan=$bulan;
        $this->tahun=$tahun;
    }

    public function view(): View
    {
        return view('cetak.laporan_amalan_group');
    }
}
