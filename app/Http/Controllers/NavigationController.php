<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function beranda_admin ( Request $request )
    {
        return view ( "admin.beranda" );
    }

    public function beranda_mahasiswa ( Request $request )
    {
        return view ( "mahasiswa.beranda" );
    }

    public function beranda_dpl ( Request $request )
    {
        return view ( "dpl.beranda" );
    }
}
