<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\Auth;

class AdminDataController extends Controller
{
    public function DataBerandaAdmin ( Request $request )
    {
        $last5_mahasiswa = Mahasiswa::with ( 'user' )->with ( 'dpl' )->orderBy ( 'id', 'desc' )->get ()->take ( 5 )->sortBy ( 'id' )->values ();
        $last5_dpl       = Dpl::with ( 'user' )->with ( 'mahasiswa' )->orderBy ( 'id', 'desc' )->get ()->take ( 5 )->sortBy ( 'id' )->values ();

        return response ()->json ( [ 'last5_mahasiswa' => $last5_mahasiswa, 'last5_dpl' => $last5_dpl ] );
    }

    public function AmbilDataMahasiswa ( Request $request )
    {
        $perPage = 25;
        $page    = $request->input ( 'page', 1 );

        // Get the records for the current page
        $DataMahasiswa = Mahasiswa::skip ( ( $page - 1 ) * $perPage )
            ->with ( 'user' )
            ->with ( 'dpl' )
            ->with ( 'laporan_harians' )
            ->with ( 'laporan_akhir' )
            ->take ( $perPage + 1 ) // Fetch one extra record to check if there are more records to fetch
            ->get ();

        $nextExists = false;
        if ( $DataMahasiswa->count () > $perPage )
        {
            $nextExists    = true;
            $DataMahasiswa = $DataMahasiswa->slice ( 0, $perPage ); // If there are more records, remove the extra one from the current page
        }

        return response ()->json ( [ 'DataMahasiswa' => $DataMahasiswa, 'nextExists' => $nextExists ] );
    }

    public function AmbilDataDpl ( Request $request )
    {
        $perPage = 25;
        $page    = $request->input ( 'page', 1 );

        // Get the records for the current page
        $DataDPL = Dpl::skip ( ( $page - 1 ) * $perPage )
            ->with ( 'user' )
            ->with ( 'mahasiswa' )
            ->take ( $perPage + 1 )
            ->get ();

        $nextExists = false;
        if ( $DataDPL->count () > $perPage )
        {
            $nextExists = true;
            $DataDPL    = $DataDPL->slice ( 0, $perPage ); // If there are more records, remove the extra one from the current page
        }

        return response ()->json ( [ 'DataDPL' => $DataDPL, 'nextExists' => $nextExists ] );
    }

    public function CariDataMahasiswa ( Request $request )
    {
        $query = $request->get ( 'query' );

        // Perform a case-insensitive search using Eloquent ORM
        $mahasiswa = Mahasiswa::with ( 'user' )
            ->with ( 'dpl' )
            ->where ( 'nama_ketua', 'LIKE', "%{$query}%" )
            ->orWhereHas ( 'user', function ($q) use ($query)
            {
                $q->where ( 'email', 'LIKE', "%{$query}%" );
            } )
            ->orWhereHas ( 'dpl', function ($q) use ($query)
            {
                $q->where ( 'nama_dosen', 'LIKE', "%{$query}%" );
            } )
            ->orWhere ( 'nim', 'LIKE', "%{$query}%" )
            ->orWhere ( 'anggota_kelompok', 'LIKE', "%{$query}%" )
            ->orWhere ( 'id', 'LIKE', "%{$query}%" )
            ->orWhere ( 'prodi', 'LIKE', "%{$query}%" )
            ->orWhere ( 'fakultas', 'LIKE', "%{$query}%" )
            ->take ( 25 )
            ->orderBy ( 'id', 'desc' )
            ->get ();

        return response ()->json ( [ 'DataMahasiswa' => $mahasiswa ] );
    }

    public function CariDataDpl ( Request $request )
    {
        $query = $request->get ( 'query' );

        // Perform a case-insensitive search using Eloquent ORM
        $dpl = Dpl::with ( 'user' )
            ->with ( 'mahasiswa' )
            ->where ( 'nama_dosen', 'LIKE', "%{$query}%" )
            ->orWhereHas ( 'user', function ($q) use ($query)
            {
                $q->where ( 'email', 'LIKE', "%{$query}%" );
            } )
            ->orWhereHas ( 'mahasiswa', function ($q) use ($query)
            {
                $q->where ( 'nama_ketua', 'LIKE', "%{$query}%" );
            } )
            ->orWhere ( 'nip', 'LIKE', "%{$query}%" )
            ->orWhere ( 'id', 'LIKE', "%{$query}%" )
            ->orWhere ( 'prodi', 'LIKE', "%{$query}%" )
            ->orWhere ( 'fakultas', 'LIKE', "%{$query}%" )
            ->take ( 25 )
            ->orderBy ( 'id', 'desc' )
            ->get ();

        return response ()->json ( [ 'DataDPL' => $dpl ] );
    }

    public function DapatkanHalamanTerakhirMahasiswa ()
    {
        $data = Mahasiswa::query (); // Replace 'Model' with your actual model

        $perPage = 25; // Set this to the number of items you want per page

        $count = $data->count ();

        $lastPage = ceil ( $count / $perPage );

        return response ()->json ( [ 'lastPage' => $lastPage ] );
    }

    public function DapatkanHalamanTerakhirDpl ()
    {
        $data = Dpl::query (); // Replace 'Model' with your actual model

        $perPage = 25; // Set this to the number of items you want per page

        $count = $data->count ();

        $lastPage = ceil ( $count / $perPage );

        return response ()->json ( [ 'lastPage' => $lastPage ] );
    }

    public function AmbilDataLaporanHarianAdmin ( Request $request )
    {
        $user    = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $request->id );
        $laporan = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->where ( 'tanggal', $request->tanggal )->get ();

        return response ()->json ( $laporan );
    }

    public function DapatkanBulanLaporanHarianAdmin ( Request $request )
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

    public function DownloadSertifikatAdmin ( Request $request )
    {
        $mahasiswa = Mahasiswa::find ( $request->ID_Mahasiswa );
        $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
        $user = User::find ( $mahasiswa->user->id );
        $user->load ( 'mahasiswa', 'dpl' );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->count ();

        $imagePath = public_path ( 'favicon.ico' );
        $test      = "data:image/png;base64," . base64_encode ( file_get_contents ( $imagePath ) );
        // dd ( $test );
        // return view ( "mahasiswa.sertifikat", [ 
        //     'navActiveItem'         => 'sertifikat',

        //     'user'                  => $user,
        //     'laporan_akhir'         => $laporan_akhir,
        //     'jumlah_laporan_harian' => $jumlah_laporan_harian,
        // ] );

        return view ( "admin.download_sertifikat", [ 
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
