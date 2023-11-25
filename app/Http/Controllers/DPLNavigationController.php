<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DPLNavigationController extends Controller
{
    public function beranda_dpl ( Request $request )
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        return view ( "dpl.beranda", [ 
            'navActiveItem' => 'beranda',

            'user'          => $user,
        ] );
    }
}
