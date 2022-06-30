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
                <th rowspan="3" colspan="10"> {{$data_jenis->nama_jenis}} <br> <p> {{$data_karyawan->nama_karyawan}} - Periode {{$data_bulan}} {{$data_tahun}}</p></th>
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
                @foreach ($data_jenis->kategori as $item)
                    <th rowspan="2">{{$item->nama_kategori}}</th>
                @endforeach
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
                            $full_tanggal = \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
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

                    @foreach ($data_jenis->kategori as $key => $item)
                        @php
                            $x = '0';
                                if ($i+1 < 10) {
                                    # code..
                                    $y = $i+1;
                                    $x = '0'.''.$y;
                                }else {
                                    # code...
                                    $x = $i+1;
                                }
                        @endphp
                        @php
                            $penilaian = App\Models\Penilaian::where('karyawan_id',$data_karyawan->id)
                            // ->with('karyawan','jenis','kategori','poin')
                                                            ->where('jenis_id',$data_jenis->id)
                                                            ->where('kategori_id',$item->id)
                                                            // ->where('tanggal',$full_tanggal)
                                                            ->first();
                        @endphp
                        
                        <td>{{$penilaian->id}}</td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>