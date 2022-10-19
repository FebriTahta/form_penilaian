<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Provinsi;

class ProvinsiImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */

    public function startRow(): int
    {
        return 1;
    }


    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
            $provinsi   = Provinsi::where('id', $row[0])->first();

            if ($provinsi == null) {
                # Provinsi baru code...
                $dt_prov = new Provinsi;
                $dt_prov->id = $row[0];
                $dt_prov->nama_provinsi = $row[1];
                $dt_prov->save();
            }else {
                # code...
                # do something else here if provinsi was exist
            }

        }
    }
}
