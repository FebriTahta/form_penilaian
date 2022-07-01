<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data_jenis->nama_jenis}}</title>
    <style>
        .notel {
        mso-number-format: "\@";
        }
    </style>
</head>
<body>
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="3" colspan="13"> {{$data_jenis->nama_jenis}} <br> <p> {{$data_karyawan->nama_karyawan}} - Periode {{$data_bulan}} {{$data_tahun}}</p></th>
            </tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead>
            <tr></tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead style="font-weight: bold; border: black">
            <tr style="border: black; text-transform: uppercase">
                <th rowspan="2">NO</th>
                <th rowspan="2">Hari</th>
                <th rowspan="2">Tanggal</th>
                <th rowspan="2">Sholat Jama'ah</th>
                <th rowspan="2">Do'a Tolak Balak</th>
                <th rowspan="2">Qobliyah</th>
                <th rowspan="2">Ba'diyah</th>
                <th rowspan="2">Lail</th>
                <th rowspan="2">Do'a NF</th>
                <th rowspan="2">Dhuha</th>
                <th rowspan="2">Al Waqi'ah</th>
                <th rowspan="2">Baca Al Qur'an</th>
                <th rowspan="2">Sujud Syukur</th>
            </tr>
        </thead >
        @php
            $jumHari   = cal_days_in_month(CAL_GREGORIAN, $bulan, $data_tahun);
        @endphp
        <tbody>
            <tr></tr>
            @for ($i = 0; $i < $jumHari; $i++)
                <tr>
                    <td>
                        {{$i+1}}
                    </td>
                    <td>
                        @php
                            $tanggal_muda = '0'.$i+1; 
                            $tanggal = $data_tahun.'-'.$bulan.'-'.$tanggal_muda;
                            $hari = \Carbon\Carbon::parse($tanggal)->format('l');
                            
                        @endphp

                        @if ($hari == 'Monday')
                            Senin
                        @elseif($hari == 'Tuesday')
                            Selasa
                        @elseif($hari == 'Wednesday')
                            Rabu
                        @elseif($hari == 'Thursday')
                            Kamis
                        @elseif($hari == 'Friday')
                            Jum'at
                        @elseif($hari == 'Saturday')
                            Sabtu
                        @elseif($hari == 'Sunday')
                            Ahad
                        @else
                            {{$hari}}
                        @endif
                    </td>
                    <td>
                        @php
                            $tanggal_awal = $i+1;
                        @endphp
                        {{$tanggal_awal.' '.$data_bulan}}
                    </td>
                    
                    @foreach ($data_jenis->kategori as $item)
                            @php
                                $tgl = '';
                                $full_tanggal = date('Y-m-d', strtotime($tanggal));
                                $tgl = (string)$tanggal_awal;
                                $val = App\Models\Penilaian::where('karyawan_id', $data_karyawan->id)
                                                        ->where('jenis_id', $data_jenis->id)
                                                        ->where('kategori_id', $item->id)
                                                        ->whereDate('tanggal', date('Y-m-d', strtotime($tanggal)))
                                                        ->first();
                            @endphp
                            <td>
                                @if ($val !== null)
                                    {{$val->poin->nama_poin}}
                                @endif
                            </td>
                    @endforeach
                    
                </tr>
            @endfor
        </tbody>
    </table>

    <table style="border: solid">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Amalan</th>
                <th rowspan="2">Target</th>
                <th rowspan="2">Real</th>
                <th rowspan="2">%</th>
                <th rowspan="2">PREDIKAT</th>
            </tr>
        </thead>

        <tbody>
            <tr></tr>
            @foreach ($data_jenis->kategori as $key=>$item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->nama_kategori}}</td>
                    <td>{{$item->poin->max('besar_poin') * $jumHari}}</td>
                    <td>
                        @php
                            $tgl = '';
                            $full_tanggal = date('Y-m-d', strtotime($tanggal));
                            $tgl = (string)$tanggal_awal;
                            $val = App\Models\Penilaian::where('karyawan_id', $data_karyawan->id)
                                                    ->where('jenis_id', $data_jenis->id)
                                                    ->where('kategori_id', $item->id)
                                                    ->whereMonth('tanggal', $bulan)
                                                    ->whereYear('tanggal', $data_tahun)
                                                    ->sum('nilai');
                        @endphp
                        {{$val}}
                    </td>

                    <td>
                        @php
                            $realnya = $val;
                            $target  = $item->poin->max('besar_poin') * $jumHari;
                        @endphp
                        @if ($realnya > 0)
                            {{round(($realnya*100)/$target)}} %
                        @else
                        -
                        @endif
                    </td>

                    <td>
                        @if ($realnya > 0)
                            @if (round($target/$realnya) < 59)
                                Kurang
                            @elseif(round($target/$realnya) > 59 && round($target/$realnya) < 70)
                                Cukup
                            @elseif(round($target/$realnya) > 69 && round($target/$realnya) < 80)
                                Baik
                            @elseif(round($target/$realnya) > 79 && round($target/$realnya) < 90)
                                Sangat baik
                            @elseif(round($target/$realnya) > 89 && round($target/$realnya) <= 100)
                                Sangat baik
                            @endif
                        @else
                            Kurang
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>