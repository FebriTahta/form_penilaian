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
                <th rowspan="3" colspan="13"> {{$data_jenis->nama_jenis}} <br> <p> GROUP - Periode {{$data_bulan}} {{$data_tahun}}</p></th>
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
   
    @foreach ($data_jenis->group as $item)
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="2" colspan="6"> {{$item->nama_group}}</th>
            </tr>
        </thead>
    </table>
    <table style="border: solid">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Amalan</th>
                <th rowspan="2">Target Perorangan</th>
                <th rowspan="2">Target Pergroup</th>
                <th rowspan="2">Real</th>
                <th rowspan="2">%</th>
                <th rowspan="2">PREDIKAT</th>
            </tr>
        </thead>
        <tbody>
            <tr></tr>
            @php
                $nilai_akhir = [];
                $x2 = '';
            @endphp
            @foreach ($data_jenis->kategori as $key => $kategori)
                @php
                    $real = [];
                    $pw = '';
                    foreach ($item->karyawan as $value) {
                        # code...
                        $val = App\Models\Penilaian::where('karyawan_id', $value->id)
                                                        ->where('kategori_id', $kategori->id)
                                                        ->whereMonth('tanggal', $bulan) 
                                                        ->whereYear('tanggal', $data_tahun)
                                                        ->sum('nilai');    
                        $real[] = $val;
                        $x  = array_sum($real);
                    }
                @endphp
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$kategori->nama_kategori}}</td>
                    <td>{{($kategori->poin->max('besar_poin') * $jumlah_hari)}}</td>
                    <td>{{($kategori->poin->max('besar_poin') * $jumlah_hari) * $item->karyawan->count()}}</td>
                    <td>
                        {{$x}}
                    </td>
                    <td>
                        @if ($x !== 0)
                            @php
                                $nilai_akhir[] = round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count()));
                                $x2 = round(array_sum($nilai_akhir) / 10)
                            @endphp
                            {{round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count()))}} %
                        @endif
                    </td>
                    <td>
                        @if ($x !== 0)
                            
                            @if (round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 59)
                                Kurang
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) > 59 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 70)
                                Cukup
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) > 69 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 80)
                                Baik
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) > 79 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 90)
                                Sangat Baik
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) > 89 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) <= 100)
                                Istimewa
                            @endif

                        @else
                            Kosong / Belum diisi
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>*</td>
                <td colspan="6">Nilai Akhir</td>
                <td>{{$x2}} / dari 100</td>
            </tr>
        </tbody>
    </table>
    @endforeach


    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="2" colspan="6"> SATU LEMBAGA (NURUL FALAH)</th>
            </tr>
        </thead>
    </table>
    <table style="border: solid">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Amalan</th>
                <th rowspan="2">Target Perorangan</th>
                <th rowspan="2">Target Satu Lembaga</th>
                <th rowspan="2">Real</th>
                <th rowspan="2">%</th>
                <th rowspan="2">PREDIKAT</th>
            </tr>
        </thead>
        <tbody>
            <tr></tr>
            @foreach ($data_jenis->kategori as $key => $kategori)
                @php
                    $real = [];
                    $karyawan = App\Models\Karyawan::all();
                    foreach ($karyawan as $value) {
                        # code...
                        $val = App\Models\Penilaian::where('karyawan_id', $value->id)
                                                        ->where('kategori_id', $kategori->id)
                                                        ->whereMonth('tanggal', $bulan) 
                                                        ->whereYear('tanggal', $data_tahun)
                                                        ->sum('nilai');    
                        $real[] = $val;
                        $x = array_sum($real);
                    }
                @endphp
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$kategori->nama_kategori}}</td>
                    <td>{{($kategori->poin->max('besar_poin') * $jumlah_hari)}}</td>
                    <td>{{($kategori->poin->max('besar_poin') * $jumlah_hari) * $karyawan->count()}}</td>
                    <td>
                        {{$x}}
                    </td>
                    <td>
                        @if ($x !== 0)
                            @php
                                $nilai_akhir[] = round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count()));
                                $x2 = round(array_sum($nilai_akhir) / 10)
                            @endphp
                            {{round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count()))}} %
                        @endif
                    </td>
                    <td>
                        @if ($x !== 0)
                            
                            @if (round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count())) < 59)
                                Kurang
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count())) > 59 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 70)
                                Cukup
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count())) > 69 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 80)
                                Baik
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count())) > 79 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) < 90)
                                Sangat Baik
                            @elseif(round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $karyawan->count())) > 89 && round(($x * 100) / ($kategori->poin->max('besar_poin') * $jumlah_hari * $item->karyawan->count())) <= 100)
                                Istimewa
                            @endif

                        @else
                            Kosong / Belum diisi
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td>*</td>
                <td colspan="6">Nilai Akhir</td>
                <td>{{$x2}} / dari 100</td>
            </tr>
        </tbody>
    </table>
    
</body>
</html>