<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\Auth;

class DPLDataController extends Controller
{
    public function AmbilDataLaporanHarianDPL ( Request $request )
    {
        $user    = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $request->id );
        $laporan = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->where ( 'tanggal', $request->tanggal )->get ();

        return response ()->json ( $laporan );
    }

    public function DapatkanBulanLaporanHarianDPL ( Request $request )
    {
        $date        = new \DateTime ( $request->date );
        $month       = $date->format ( 'm' );
        $year        = $date->format ( 'Y' );
        $daysInMonth = cal_days_in_month ( CAL_GREGORIAN, $month, $year );
        $firstDay    = date ( 'N', strtotime ( "{$year}-{$month}-01" ) );

        return response ()->json ( [ 
            'month'       => $month,
            'year'        => $year,
            'daysInMonth' => $daysInMonth,
            'firstDay'    => $firstDay,
        ] );
    }

    public function DownloadSertifikatDPL ()
    {
        $id            = Auth::user ()->id;
        $user          = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->first ();

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->count ();

        $imagePath = public_path ( 'favicon.ico' );
        $test      = "data:image/png;base64," . base64_encode ( file_get_contents ( $imagePath ) );
        // dd ( $test );
        // return view ( "mahasiswa.sertifikat", [ 
        //     'navActiveItem'         => 'sertifikat',

        //     'user'                  => $user,
        //     'laporan_akhir'         => $laporan_akhir,
        //     'jumlah_laporan_harian' => $jumlah_laporan_harian,
        // ] );

        return view ( "dpl.download_sertifikat", [ 
            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'imagePath'             => $test,
        ] );

        // $mpdf = new \Mpdf\Mpdf ();
        // $mpdf->WriteHTML ( view ( "mahasiswa.download_sertifikat", [ 
        //     'user'                  => $user,
        //     'laporan_akhir'         => $laporan_akhir,
        //     'jumlah_laporan_harian' => $jumlah_laporan_harian,
        //     'imagePath'             => $test,
        // ] ) );
        // $mpdf->Output ();
    }
}
