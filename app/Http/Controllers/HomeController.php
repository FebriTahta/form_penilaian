<?php

namespace App\Http\Controllers;
use App\Models\Poin;
use App\Models\Kategori;
use App\Models\Jenis;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $poin = Poin::count();
        $kategori = Kategori::count();
        $jenis = Jenis::count();
        $karyawan = Karyawan::count();
        return view('page.dashboard',compact('poin','kategori','jenis','karyawan'));
    }
}
