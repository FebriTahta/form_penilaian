<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use App\Models\Kelurahan;

class KelurahanImport implements ToCollection, WithChunkReading, WithStartRow, ShouldQueue
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
            $kelurahan   = Kelurahan::where('id', $row[0])->first();

            if ($kelurahan == null) {
                # Provinsi baru code...
                $dt_kel = new Kelurahan;
                $dt_kel->id = $row[0];
                $dt_kel->kecamatan_id = $row[1];
                $dt_kel->nama_kelurahan = $row[2];
                $dt_kel->save();
            }else {
                # code...
                # do something else here if provinsi was exist
            }

        }
    }

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
