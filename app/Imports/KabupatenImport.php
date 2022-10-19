<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Kabupaten;

class KabupatenImport implements ToCollection
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
            $kabupaten   = Kabupaten::where('id', $row[0])->first();

            if ($kabupaten == null) {
                # Provinsi baru code...
                $dt_kab = new Kabupaten;
                $dt_kab->id = $row[0];
                $dt_kab->provinsi_id = $row[1];
                $dt_kab->nama_kabupaten = $row[2];
                $dt_kab->save();
            }else {
                # code...
                # do something else here if provinsi was exist
            }

        }
    }
}
