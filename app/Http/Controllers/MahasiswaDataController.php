<?php

namespace App\Http\Controllers;

use App\Models\LaporanHarian;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaDataController extends Controller
{
    public function AmbilDataLaporan ( Request $request )
    {
        $user    = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $request->id );
        $laporan = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->where ( 'tanggal', $request->tanggal )->get ();

        return response ()->json ( $laporan );
    }

}
