<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Models\LaporanAkhir;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function index()
    {
        $id            = Auth::user ()->id;
        $user          = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

        $sudah_punya_dpl = false;

        if ( $user->mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->count ();

        return view ( "mahasiswa.sertifikat.index", [
            'navActiveItem'         => 'sertifikat',
            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'sudah_punya_dpl'       => $sudah_punya_dpl,
        ] );
    }

    public function download(Mahasiswa $mahasiswa)
    {
        $id            = Auth::user ()->id;
        $user          = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $mahasiswa->id )->first ();

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $mahasiswa->id )->count ();

        $imagePath = public_path ( 'favicon.ico' );
        $test      = "data:image/png;base64," . base64_encode ( file_get_contents ( $imagePath ) );

        return view ( "mahasiswa.sertifikat.download", [ 
            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'imagePath'             => $test,
        ] );
    }
}
