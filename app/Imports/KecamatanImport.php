<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Kecamatan;

class KecamatanImport implements ToCollection,WithStartRow
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
            $kabupaten   = Kecamatan::where('id', $row[0])->first();

            if ($kabupaten == null) {
                # Provinsi baru code...
                $dt_kab = new Kecamatan;
                $dt_kab->id = $row[0];
                $dt_kab->kabupaten_id = $row[1];
                $dt_kab->nama_kecamatan = $row[2];
                $dt_kab->save();
            }else {
                # code...
                # do something else here if provinsi was exist
            }

        }
    }
}
