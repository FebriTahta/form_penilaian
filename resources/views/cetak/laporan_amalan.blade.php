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
                <th rowspan="2">Sholat Jamaah</th>
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
        <tbody>
            <tr></tr>
            @foreach ($karyawan->mengisi as $key=> $item)
            <tr>
                <td>{{$key+1}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>