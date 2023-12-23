<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        return view ( "mahasiswa.beranda.index", [
            'navActiveItem' => 'beranda',
            'user'          => $user,
        ] );
    }

    public function getData(Request $request)
    {
        $user    = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $request->id );
        $laporan = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->where ( 'tanggal', $request->tanggal )->get ();

        return response ()->json ( $laporan );
    }
}
