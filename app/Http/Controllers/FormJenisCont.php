<?php

namespace App\Http\Controllers;
use App\Models\Jenis;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Image;
use File;

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
}
