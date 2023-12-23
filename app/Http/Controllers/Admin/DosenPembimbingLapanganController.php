<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dpl;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenPembimbingLapanganController extends Controller
{
    public $mainRoute = 'admin.dosen_pembimbing_lapangan.index';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlah_dpl = DPL::count ();

        return view ( "admin.dosen_pembimbing_lapangan.index", [
            'navActiveItem' => 'data_kelompok_mahasiswa',
            'jumlah_dpl'    => $jumlah_dpl,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa_kosong = Mahasiswa::with ( 'user' )->where ( 'dpl_id', null )->get ();

        return view ( "admin.dosen_pembimbing_lapangan.create", [
            'navActiveItem'    => 'data_kelompok_mahasiswa',
            'mahasiswa_kosong' => $mahasiswa_kosong,
        ] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate ( [
            'NamaDPL___'       => [ 'required' ],
            'Email___'         => [ 'required' ],
            'Password___'      => [ 'min:6', 'required' ],
            'NIP___'           => [ 'required' ],
            'Prodi___'         => [ 'required' ],
            'Fakultas___'      => [ 'required' ],
            'KetuaKelompok___' => [ 'nullable' ],
        ] );

        $user           = new User ();
        $user->email    = $request->Email___;
        $user->password = Hash::make ( $request->Password___ );

        $dpl             = new DPL ();
        $dpl->nama_dosen = $request->NamaDPL___;
        $dpl->nip        = $request->NIP___;
        $dpl->prodi      = $request->Prodi___;
        $dpl->fakultas   = $request->Fakultas___;
        if ( $request->KetuaKelompok___ != 'null' )
        {
            $dpl->mahasiswa_id = $request->KetuaKelompok___;
        }

        $dpl->save ();
        $user->save ();

        $user->dpl_id = $dpl->id;
        $dpl->user_id = $user->id;

        $dpl->save ();
        $user->save ();

        if ( $request->KetuaKelompok___ != 'null' )
        {
            Mahasiswa::where ( 'id', $request->KetuaKelompok___ )->update ( [ 'dpl_id' => $dpl->id ] );
        }

        return redirect ()->route ($this->mainRoute)->with ( 'success', 'Data Kelompok Baru Berhasil Ditambahkan!' );
    }

    /**
     * Display the specified resource.
     */
    public function show(Dpl $dpl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dpl $dpl)
    {
        $mahasiswa_kosong   = Mahasiswa::with ( 'user' )->where ( 'dpl_id', null )->get ();
        $mahasiswa_sekarang = Mahasiswa::with ( 'user' )->where ( 'dpl_id', $dpl->id )->get ()->first ();

        $selected_dpl = DPL::with ( 'user' )->find ( $dpl->id );

        return view ( "admin.dosen_pembimbing_lapangan.edit", [
            'navActiveItem'      => 'data_kelompok_mahasiswa',
            'dpl'                => $selected_dpl,
            'mahasiswa_kosong'   => $mahasiswa_kosong,
            'mahasiswa_sekarang' => $mahasiswa_sekarang,
        ] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dpl $dpl)
    {
        $request->validate ( [
            'NamaDPL___'                  => [ 'required' ],
            'Email___'                    => [ 'required', 'email' ],
            'Password___'                 => [ 'min:6', 'nullable' ],
            'NIP___'                      => [ 'required' ],
            'Prodi___'                    => [ 'required' ],
            'Fakultas___'                 => [ 'required' ],
            'KetuaKelompok___'            => [ 'nullable' ],
            'KetuaKelompok_Sebelumnya___' => [ 'nullable' ],
        ] );

        $user = User::find ( $dpl->user_id );

        $dpl->update ( [
            'nama_dosen' => $request->NamaDPL___,
            'nip'        => $request->NIP___,
            'prodi'      => $request->Prodi___,
            'fakultas'   => $request->Fakultas___,
        ] );

        if ( $request->KetuaKelompok___ != 'null' )
        {
            $dpl->update ( [
                'mahasiswa_id' => $request->KetuaKelompok___,
            ] );
            Mahasiswa::where ( 'id', $request->KetuaKelompok___ )->update ( [ 'dpl_id' => $dpl->id ] );
        }
        else
        {
            $dpl->update ( [
                'mahasiswa_id' => null,
            ] );
            Mahasiswa::where ( 'id', $request->KetuaKelompok_Sebelumnya___ )->update ( [ 'dpl_id' => null ] );
        }

        if ( $request->Password___ != null )
        {
            $user->update ( [
                'password' => Hash::make ( $request->Password___ ),
            ] );
        }

        $user->update ( [
            'email'    => $request->Email___,
            'password' => Hash::make ( $request->Password___ ),
        ] );

        $dpl->save ();
        $user->save ();

        return redirect ()->route ($this->mainRoute)->with ( 'success', 'Data Kelompok Berhasil Diubah!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dpl $dpl)
    {
        $user = User::find ( $dpl->user_id );

        //delete data mahasiswa dan data user
        $dpl->delete ();
        $user->delete ();

        return redirect ()->route ($this->mainRoute)->with ( 'success', 'Data Kelompok Berhasil Dihapus!' );
    }

    public function getData(Request $request)
    {
        $perPage = 25;
        $page    = $request->input ( 'page', 1 );

        // Get the records for the current page
        $dataDPL = DPL::skip ( ( $page - 1 ) * $perPage )
            ->with ( 'user' )
            ->with ( 'mahasiswa' )
            ->take ( $perPage + 1 )
            ->latest()
            ->get ();

        $nextExists = false;
        if ( $dataDPL->count () > $perPage )
        {
            $nextExists = true;
            // If there are more records, remove the extra one from the current page
            $dataDPL    = $dataDPL->slice ( 0, $perPage );
        }

        return response ()->json ( [ 'DataDPL' => $dataDPL, 'nextExists' => $nextExists ] );
    }

    public function findData(Request $request)
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

    public function lastData()
    {
        $data = DPL::query (); // Replace 'Model' with your actual model

        $perPage = 25; // Set this to the number of items you want per page

        $count = $data->count ();

        $lastPage = ceil ( $count / $perPage );

        return response ()->json ( [ 'lastPage' => $lastPage ] );
    }
}
