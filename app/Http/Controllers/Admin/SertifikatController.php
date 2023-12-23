<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dpl;
use App\Models\LaporanAkhir;
use App\Models\LaporanHarian;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $jumlah_mahasiswa  = Mahasiswa::count ();
        $jumlah_dpl        = DPL::count ();
        $jumlah_sertifikat = LaporanAkhir::where ( 'approved', true )->count ();

        return view ( "admin.sertifikat.index", [
            'navActiveItem'     => 'sertifikat',
            'jumlah_mahasiswa'  => $jumlah_mahasiswa,
            'jumlah_dpl'        => $jumlah_dpl,
            'jumlah_sertifikat' => $jumlah_sertifikat,
        ] );
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
        $user = User::find ( $mahasiswa->user->id );
        $user->load ( 'mahasiswa', 'dpl' );

        $laporan_akhir         = LaporanAkhir::where ( 'mahasiswa_id', $mahasiswa->id )->firstOrFail ();
        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->count ();

        return view ( "admin.sertifikat.show", [
            'navActiveItem'         => 'admin.sertifikat',
            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
        ] );
    }

    public function download(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
        $user = User::find ( $mahasiswa->user->id );
        $user->load ( 'mahasiswa', 'dpl' );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->count ();

        $imagePath = public_path ( 'favicon.ico' );
        $test      = "data:image/png;base64," . base64_encode ( file_get_contents ( $imagePath ) );

        return view ( "admin.download_sertifikat", [
            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'imagePath'             => $test,
        ] );
    }
}
