<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        return view ( "dpl.beranda.index", [ 
            'navActiveItem' => 'beranda',
            'user' => $user,
        ] );
    }
}
