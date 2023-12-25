<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarMahasiswa;
use Illuminate\Http\Request;

class PendaftaranMahasiswaController extends Controller
{
    public $mainRoute = 'admin.pendaftaran_mahasiswa.index';

    /**
     * Display a listing of the resource.
     */
    public function index ()
    {
        $navActiveItem                = 'data_pendaftaran_mahasiswa';
        $jumlah_pendaftaran_mahasiswa = DaftarMahasiswa::count ();

        return view ( 'admin.pendaftaran_mahasiswa.index', compact ( 'navActiveItem', 'jumlah_pendaftaran_mahasiswa' ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create ()
    {
        $navActiveItem = 'data_pendaftaran_mahasiswa';
        return view ( 'admin.pendaftaran_mahasiswa.create', compact ( 'navActiveItem' ) );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store ( Request $request )
    {
        $request->validate ( [ 
            'Nama___'     => [ 'required' ],
            'NIM___'      => [ 'required' ],
            'Prodi___'    => [ 'required' ],
            'Fakultas___' => [ 'required' ],
            'Periode___'  => [ 'required' ],
        ] );

        $mahasiswa           = new DaftarMahasiswa ();
        $mahasiswa->nama     = $request->Nama___;
        $mahasiswa->nim      = $request->NIM___;
        $mahasiswa->prodi    = $request->Prodi___;
        $mahasiswa->fakultas = $request->Fakultas___;
        $mahasiswa->periode  = $request->Periode___;

        $mahasiswa->save ();

        return redirect ()->route ( $this->mainRoute )->with ( 'success', 'Data Mahasiswa Baru Berhasil Ditambahkan!' );
    }

    /**
     * Display the specified resource.
     */
    public function show ( DaftarMahasiswa $mahasiswa )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit ( DaftarMahasiswa $mahasiswa )
    {
        $navActiveItem = 'data_pendaftaran_mahasiswa';
        return view ( 'admin.pendaftaran_mahasiswa.edit', [ 
            'navActiveItem' => 'data_pendaftaran_mahasiswa',
            'mahasiswa'     => $mahasiswa,
        ] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update ( Request $request, DaftarMahasiswa $mahasiswa )
    {
        $request->validate ( [ 
            'Nama___'     => [ 'required' ],
            'NIM___'      => [ 'required' ],
            'Prodi___'    => [ 'required' ],
            'Fakultas___' => [ 'required' ],
            'Periode___'  => [ 'required' ],
        ] );

        $mahasiswa->update ( [ 
            'nama'     => $request->Nama___,
            'nim'      => $request->NIM___,
            'prodi'    => $request->Prodi___,
            'fakultas' => $request->Fakultas___,
            'periode'  => $request->Periode___,
        ] );

        $mahasiswa->save ();

        return redirect ()->route ( $this->mainRoute )->with ( 'success', 'Data Mahasiswa Berhasil Diubah!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ( DaftarMahasiswa $mahasiswa )
    {
        $mahasiswa->delete ();

        return redirect ()->route ( $this->mainRoute )->with ( 'success', 'Data Mahasiswa Berhasil Dihapus!' );
    }

    public function getData ( Request $request )
    {
        $perPage = 25;
        $page    = $request->input ( 'page', 1 );

        // Get the records for the current page
        $dataMahasiswa = DaftarMahasiswa::skip ( ( $page - 1 ) * $perPage )
            ->take ( $perPage + 1 ) // Fetch one extra record to check if there are more records to fetch
            ->latest ()
            ->get ();

        $nextExists = false;
        if ( $dataMahasiswa->count () > $perPage )
        {
            $nextExists = true;
            // If there are more records, remove the extra one from the current page
            $dataMahasiswa = $dataMahasiswa->slice ( 0, $perPage );
        }

        return response ()->json ( [ 'DataMahasiswa' => $dataMahasiswa, 'nextExists' => $nextExists ] );
    }

    public function findData ( Request $request )
    {
        $query = $request->get ( 'query' );

        // Perform a case-insensitive search using Eloquent ORM
        $mahasiswa = DaftarMahasiswa::where ( 'nama', 'LIKE', "%{$query}%" )
            ->orWhere ( 'nim', 'LIKE', "%{$query}%" )
            ->orWhere ( 'fakultas', 'LIKE', "%{$query}%" )
            ->orWhere ( 'prodi', 'LIKE', "%{$query}%" )
            ->orWhere ( 'periode', 'LIKE', "%{$query}%" )
            ->take ( 25 )
            ->orderBy ( 'id', 'desc' )
            ->get ();

        return response ()->json ( [ 'DataMahasiswa' => $mahasiswa ] );
    }

    public function lastData ()
    {
        $data = DaftarMahasiswa::query (); // Replace 'Model' with your actual model

        $perPage = 25; // Set this to the number of items you want per page

        $count = $data->count ();

        $lastPage = ceil ( $count / $perPage );

        return response ()->json ( [ 'lastPage' => $lastPage ] );
    }

    public function export ()
    {
        $fileName = 'data.csv';
        $data     = DaftarMahasiswa::all (); // replace with your model

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array( 'ID', 'Nama', 'NIM', 'Prodi', 'Fakultas', 'Periode' ); // replace with your column names

        $callback = function () use ($data, $columns)
        {
            $file = fopen ( 'php://output', 'w' );
            fputcsv ( $file, $columns );

            foreach ( $data as $item )
            {
                $row[ 'ID' ]       = $item->id;
                $row[ 'Nama' ]     = $item->nama;
                $row[ 'NIM' ]      = $item->nim;
                $row[ 'Prodi' ]    = $item->prodi;
                $row[ 'Fakultas' ] = $item->fakultas;
                $row[ 'Periode' ] = $item->periode;

                fputcsv ( $file, array( $row[ 'ID' ], $row[ 'Nama' ], $row[ 'NIM' ], $row[ 'Prodi' ], $row[ 'Fakultas' ], $row[ 'Periode' ] ) );
            }

            fclose ( $file );
        };

        return response ()->stream ( $callback, 200, $headers );
    }

}
