<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use File;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Mengisi;
use App\Models\Poin;
use App\Models\Karyawan;
use App\Models\Penilaian;

class FormJenisCont extends Controller
{
    public function index_jenis(Request $request)
    {
        $total_jenis = Jenis::count();
        $jenis = Jenis::all();
        return view('page.jenis_penilaian',compact('total_jenis','jenis'));
    }

    public function store_jenis(Request $request)
    {
        $filename1   = time().'.'.$request->img_jenis->getClientOriginalExtension();
        $filename2   = time().'.'.$request->img_thumbnail_jenis->getClientOriginalExtension();
        $request->img_thumbnail_jenis->move(public_path('img/img_thumbnail_jenis/'), $filename2);
        $request->img_jenis->move(public_path('img/img_jenis/'), $filename1);


        if ($request->img_jenis !== null && $request->img_thumbnail_jenis !== null) {
            # code...
            $data   = Jenis::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'nama_jenis'            => $request->nama_jenis,
                    'img_jenis'             => asset('img/img_jenis/'.$filename1),
                    'img_thumbnail_jenis'   => asset('img/img_thumbnail_jenis/'.$filename2),
                    'slug_jenis'            => Str::slug($request->nama_jenis)
                ]
            );
        }

        return redirect()->back();
    }

    public function update_jenis(Request $request)
    {
        $data = Jenis::find($request->id);

        if ($request->img_jenis !== null && $request->img_thumbnail_jenis !== null) {
            # semua gambar diperbarui code...
            # hapus gambar yang akan direplace...
            // unlink($data->img_jenis);
            // unlink($data->img_thumbnail_jenis);
            File::delete($data->img_jenis);
            File::delete($data->img_thumbnail_jenis);
            $filename1   = time().'.'.$request->img_jenis->getClientOriginalExtension();
            $filename2   = time().'.'.$request->img_thumbnail_jenis->getClientOriginalExtension();
            $request->img_thumbnail_jenis->move(public_path('img/img_thumbnail_jenis/'), $filename2);
            $request->img_jenis->move(public_path('img/img_jenis/'), $filename1);

            Jenis::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'nama_jenis'            => $request->nama_jenis,
                    'img_jenis'             => asset('img/img_jenis/'.$filename1),
                    'img_thumbnail_jenis'   => asset('img/img_thumbnail_jenis/'.$filename2),
                    'slug_jenis'            => Str::slug($request->nama_jenis)
                ]
            );
        }

        if ($request->img_jenis !== null && $request->img_thumbnail_jenis == null) {
            # gambar flyer diperbarui dan thumbnail tidak code...
            # hapus gambar yang akan direplace...
            // unlink($data->img_jenis);
            File::delete($data->img_jenis);
            $filename1   = time().'.'.$request->img_jenis->getClientOriginalExtension();
            $request->img_jenis->move(public_path('img/img_jenis/'), $filename1);

            Jenis::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'nama_jenis'            => $request->nama_jenis,
                    'img_jenis'             => asset('img/img_jenis/'.$filename1),
                    'slug_jenis'            => Str::slug($request->nama_jenis)
                ]
            );
        }

        if ($request->img_jenis == null && $request->img_thumbnail_jenis !== null) {
            # gambar thumbnail diperbarui dan flyer tidak code...
            # hapus gambar yang di replace...
            // unlink($data->img_thumbnail_jenis);
            File::delete($data->img_thumbnail_jenis);
            $filename2   = time().'.'.$request->img_thumbnail_jenis->getClientOriginalExtension();
            $request->img_thumbnail_jenis->move(public_path('img/img_thumbnail_jenis/'), $filename2);

            Jenis::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'nama_jenis'            => $request->nama_jenis,
                    'img_thumbnail_jenis'   => asset('img/img_thumbnail_jenis/'.$filename2),
                    'slug_jenis'            => Str::slug($request->nama_jenis)
                ]
            );
        }

        if ($request->img_jenis == null && $request->img_thumbnail_jenis == null) {
            # code...
            Jenis::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'nama_jenis'            => $request->nama_jenis,
                    'slug_jenis'            => Str::slug($request->nama_jenis)
                ]
            );
        }

        return redirect()->back();
    }

    public function form_penilaian(Request $request, $slug_jenis)
    {
        $jenis = Jenis::where('slug_jenis', $slug_jenis)->first();
        return view('fe.form_penilaian',compact('jenis'));
    }

    public function find_nama_karyawan(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = User::select('id','name')
                    ->where('id','LIKE','%' .$search . '%')
                    ->orWhere('name', 'LIKE', '%' .$search . '%')
                    ->get();
        }else{
            $data = User::select('id','name')->get();
        }
        return response()->json($data);
    }

    public function form_penilaian_karyawan(Request $request)
    {
        $tanggal  = $request->dates;
        $jenis = Jenis::where('slug_jenis', $request->slug_jenis)->first();
        $user  = User::where('id',$request->user_id)->first();
        $karyawan = Karyawan::where('user_id', $user->id)->first();
        $kategori = Kategori::where('jenis_id', $jenis->id)->get();
        $penilaian = Penilaian::where('karyawan_id', $karyawan->id)->where('jenis_id', $jenis->id)->where('tanggal', $tanggal)->count();

        if ($karyawan->jenkel == 'P' && $jenis->nama_jenis == 'Penilaian Kinerja SDM Nurul Falah') {
            # code...
            return view('fe.form_berhalangan',compact('jenis','user','kategori','karyawan','tanggal','penilaian'));
        }else {
            # code...
            return view('fe.form_penilaian2',compact('jenis','user','kategori','karyawan','tanggal','penilaian'));
        }
    }

    public function submit_form(Request $request)
    {

        $mengisi = Mengisi::updateOrCreate(['id'=>$request->id],
        [
            'karyawan_id' => $request->karyawan_id,
            'jenis_id'    => $request->jenis_id,
            'keterangan'  => $value->kategori_id,
            'tanggal'     => $request->tanggal,
        ]);

        $jenis   = Jenis::find($request->jenis_id);

        $poins      = Poin::find(array_values($request->input('poins')));
        foreach ($poins as $key => $value) {
            # code...
            $data = Penilaian::updateOrCreate(['id'=>$request->id],
            [
                'karyawan_id' => $request->karyawan_id,
                'jenis_id'    => $request->jenis_id,
                'kategori_id' => $value->kategori_id,
                'poin_id'     => $value->id,
                'nilai'       => $value->besar_poin,
                'tanggal'     => $request->tanggal,
            ]);
        }
        
        return view('fe.form_sukses',compact('jenis'));
        
    }

    public function submit_berhalangan(Request $request)
    {
        $mengisi = Mengisi::updateOrCreate(['id'=>$request->id],
        [
            'karyawan_id' => $request->karyawan_id,
            'jenis_id'    => $request->jenis_id,
            'tanggal'     => $request->tanggal,
            'keterangan'  => $request->berhalangan,
        ]);

        if ($request->berhalangan == 'berhalangan') {
            # code...
            $data = Penilaian::updateOrCreate(['id'=>$request->id],
            [
                'karyawan_id' => $request->karyawan_id,
                'jenis_id'    => $request->jenis_id,
                'tanggal'     => $request->tanggal,
                'keterangan'  => $request->berhalangan,
            ]);

            $jenis = Jenis::find($request->jenis_id);
            return view('fe.form_sukses',compact('jenis'));

        }else {
            # code...
            $tanggal  = $request->tanggal;
            $jenis = Jenis::where('id', $request->jenis_id)->first();
            $karyawan = Karyawan::where('id', $request->karyawan_id)->first();
            $kategori = Kategori::where('jenis_id', $request->jenis_id)->get();
            $penilaian = Penilaian::where('karyawan_id', $karyawan->id)->where('jenis_id', $jenis->id)->where('tanggal', $tanggal)->count();

            return view('fe.form_penilaian2',compact('jenis','kategori','karyawan','tanggal','penilaian'));
            
        }
    }

    public function sukses_form($jenis_id)
    {
        $jenis = Jenis::find($jenis_id);
        return view('fe.form_sukses',compact('jenis'));
    }
}
