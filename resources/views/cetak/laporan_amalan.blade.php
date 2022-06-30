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
                        @if (strlen($i+1) == 1)
                            0{{$i+1}}    
                        @else
                            {{$i+1}}    
                        @endif
                    </td>
                    @php
                        if (strlen($i+1) == 1) {
                            # code...
                            $tanggal_muda = '0'.$i+1;
                            $tanggal = $data_tahun.'-'.$bulan.'-'.settype($tanggal_muda, "integer");
                        }else {
                            # code...
                            $tanggal_muda = $i+1;
                            $tanggal = $data_tahun.'-'.$bulan.'-'.settype($tanggal_muda, "integer");
                        }
                    @endphp
                    <td>
                        @if (strlen($i+1) == 1)
                            @php
                               $tanggal_muda = '0'.$i+1; 
                            @endphp
                            {{$tanggal = $data_tahun.'-'.$bulan.'-'.settype($tanggal_muda, "integer")}}
                        @else
                            
                        @endif
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>
</body>
</html>