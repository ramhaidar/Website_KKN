<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dpl;
use App\Models\Mahasiswa;

class BerandaController extends Controller
{
    public function index()
    {
        $navActiveItem = 'beranda';
        $jumlah_mahasiswa = Mahasiswa::count();
        $jumlah_dpl       = Dpl::count();
        $last5_mahasiswa  = Mahasiswa::latest()->with ('user')->take(5)->get();
        $last5_dpl        = Dpl::latest()->with ('user')->take(5)->get();

        return view('admin.beranda.index', compact(
            'navActiveItem',
            'jumlah_mahasiswa',
            'jumlah_dpl',
            'last5_mahasiswa',
            'last5_dpl',
        ));
    }

    public function getData()
    {
        $last5_mahasiswa = Mahasiswa::with('user')->with('dpl')->latest()->get()->take(5)->values();
        $last5_dpl = Dpl::with('user')->with('mahasiswa')->latest()->get()->take(5)->values();

        return response ()->json ( [ 'last5_mahasiswa' => $last5_mahasiswa, 'last5_dpl' => $last5_dpl ]);
    }
}
