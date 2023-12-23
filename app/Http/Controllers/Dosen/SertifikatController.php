<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\LaporanHarian;
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
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->first ();

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->count ();

        return view ( "dpl.sertifikat", [ 
            'navActiveItem'         => 'sertifikat',

            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'sudah_punya_mahasiswa' => $sudah_punya_mahasiswa,
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

        return view ( "dpl.download_sertifikat", [
            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'imagePath'             => $test,
        ] );
    }
}
