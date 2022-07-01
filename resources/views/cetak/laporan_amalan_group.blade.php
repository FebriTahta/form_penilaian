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
                <th rowspan="2">Target</th>
                <th rowspan="2">Real</th>
                <th rowspan="2">%</th>
                <th rowspan="2">PREDIKAT</th>
            </tr>
        </thead>
        @php
            
        @endphp
        <tbody>
            <tr></tr>
            @foreach ($data_jenis->kategori as $key => $kategori)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$kategori->nama_kategori}}</td>
                    <td>{{$kategori->poin->max('besar_poin') * $jumlah_hari}}</td>

                    @php
                        $nilai[] = '';
                        $real    = 0 ;
                        foreach ($item->karyawan as $key => $value) {
                            # code...
                            $nilai[] = $value->distinct('nama_karyawan');
                        }
                    @endphp
                    <td>
                        {{$nilai}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
    
</body>
</html>