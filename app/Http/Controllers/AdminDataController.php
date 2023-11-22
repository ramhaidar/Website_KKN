<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminDataController extends Controller
{
    public function DataBerandaAdmin ( Request $request )
    {
        $last5_mahasiswa = Mahasiswa::with ( 'user' )->with ( 'dpl' )->orderBy ( 'id', 'desc' )->get ()->take ( 5 )->sortBy ( 'id' )->values ();
        $last5_dpl       = DPL::with ( 'user' )->with ( 'mahasiswa' )->orderBy ( 'id', 'desc' )->get ()->take ( 5 )->sortBy ( 'id' )->values ();

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

    public function AmbilDataDPL ( Request $request )
    {
        $perPage = 25;
        $page    = $request->input ( 'page', 1 );

        // Get the records for the current page
        $DataDPL = DPL::skip ( ( $page - 1 ) * $perPage )
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

    public function CariDataDPL ( Request $request )
    {
        $query = $request->get ( 'query' );

        // Perform a case-insensitive search using Eloquent ORM
        $dpl = DPL::with ( 'user' )
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

    public function DapatkanHalamanTerakhirDPL ()
    {
        $data = DPL::query (); // Replace 'Model' with your actual model

        $perPage = 25; // Set this to the number of items you want per page

        $count = $data->count ();

        $lastPage = ceil ( $count / $perPage );

        return response ()->json ( [ 'lastPage' => $lastPage ] );
    }

}
