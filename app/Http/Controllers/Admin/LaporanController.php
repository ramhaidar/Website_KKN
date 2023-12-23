<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dpl;
use App\Models\LaporanAkhir;
use App\Models\LaporanHarian;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $jumlah_mahasiswa      = Mahasiswa::count ();
        $jumlah_dpl            = Dpl::count ();
        $jumlah_laporan_harian = LaporanHarian::count ();
        $jumlah_laporan_akhir  = LaporanAkhir::count ();

        return view ("admin.laporan.index", [
            'navActiveItem'         => 'laporan',
            'jumlah_mahasiswa'      => $jumlah_mahasiswa,
            'jumlah_dpl'            => $jumlah_dpl,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'jumlah_laporan_akhir'  => $jumlah_laporan_akhir,
        ] );
    }

    public function laporan_harian(Mahasiswa $mahasiswa)
    {
        $mode_halaman = "laporan_harian";

        $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
        $user = User::find ( $mahasiswa->user->id );
        $user->load ( 'mahasiswa', 'dpl' );

        return view ( "admin.laporan.laporan_harian", [
            'navActiveItem' => 'laporan',
            'mode_halaman'  => $mode_halaman,
            'user'          => $user,
        ] );
    }
}
