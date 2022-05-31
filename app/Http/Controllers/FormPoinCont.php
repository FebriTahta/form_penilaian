<?php

namespace App\Http\Controllers;
use App\Models\Poin;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class FormPoinCont extends Controller
{
    public function store_poin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id'   => 'required',
            'nama_poin'     => 'required',
            'besar_poin'    => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Response Gagal',
                'errors' => $validator->messages(),
            ]);

        }else {
        
            Poin::updateOrCreate(
                [
                    'id'=>$request->id
                ],
                [
                    'besar_poin'    => $request->besar_poin,
                    'nama_poin'     => $request->nama_poin,
                    'kategori_id'   => $request->kategori_id,
                    'slug_poin'     => Str::slug($request->nama_poin)
                ]
            );

            return response()->json(
                [
                'status'  => 200,
                'message' => 'Poin Penilaian has been Added',
                ]
            );
        }
    }
}
