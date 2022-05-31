<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use Illuminate\Support\Str;
use App\Models\Jabatan;

class KaryawanImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {
        
            if (is_numeric($row[4]) !== false) {
                # code...
                $tgllahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]);
            }else {
                # code...
                $tgllahir="";
            }

            $user       = User::where('name',$row[0])->first();
            $jabatan    = Jabatan::where('nama_jabatan', $row[2])->first();
            $karyawan   = Karyawan::where('nama_karyawan', $row[0])->first();

            if ($user == null) {
                # user baru code...
                $dt_user = new User;
                $dt_user->name = $row[0];
                $dt_user->pass = 'admin';
                $dt_user->password = Hash::make('admin');
                $dt_user->save();
            }

            if($jabatan == null)
            {
                # jabatan baru code...
                $dt_jab = new Jabatan;
                $dt_jab->nama_jabatan = $row[2];
                $dt_jab->slug_jabatan = Str::slug($row[2]);
                $dt_jab->save();
            }

            if ($karyawan == null) {
                # karyawan baru code...
                $dt_kar = new Karyawan;
                
                if ($jabatan !== null) {
                    # sudah ada code...
                    $dt_kar->jabatan_id     = $jabatan->id;
                }else {
                    # jabatan baru code...
                    $dt_jab = new Jabatan;
                    $dt_jab->nama_jabatan   = $row[2];
                    $dt_jab->slug_jabatan   = Str::slug($row[2]);
                    $dt_jab->save();

                    # menghubungkan karyawan dengan jabatan baru
                    $dt_kar->jabatan_id     = $dt_jab->id;
                }

                if ($user !== null) {
                    # sudah ada code...
                    $dt_kar->user_id        = $user->id;
                }else {
                    # code...
                    $dt_user = new User;
                    $dt_user->name = $row[0];
                    $dt_user->pass = 'admin';
                    $dt_user->password = Hash::make('admin');
                    $dt_user->save();

                    # menghubungkan karyawan dengan user baru
                    $dt_kar->user_id        = $dt_user->id;
                }

                $dt_kar->nama_karyawan = $row[0];
                $dt_kar->slug_karyawan = Str::slug($row[0]);
                $dt_kar->telp_karyawan = $row[1];
                $dt_kar->tempatlahir_karyawan = $row[3];
                $dt_kar->tanggallahir_karyawan= $tgllahir;
                $dt_kar->alamat_karyawan      = $row[5];
                $dt_kar->save();
            }

        }
    }
}
