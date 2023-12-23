<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dpl;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelompokMahasiswaController extends Controller
{
    public $mainRoute = 'admin.kelompok_mahasiswa.index';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $navActiveItem = 'data_kelompok_mahasiswa';
        $jumlah_mahasiswa = Mahasiswa::count();

        return view('admin.kelompok_mahasiswa.index', compact('navActiveItem', 'jumlah_mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $navActiveItem = 'data_kelompok_mahasiswa';
        $dpl_kosong = DPL::with ( 'user' )->where ( 'mahasiswa_id', null )->get ();
        return view('admin.kelompok_mahasiswa.create', compact('dpl_kosong', 'navActiveItem'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate ( [
            'NamaKetua___'       => [ 'required' ],
            'Email___'           => [ 'required', 'email' ],
            'Password___'        => [ 'min:6', 'required' ],
            'AnggotaKelompok___' => [ 'required' ],
            'NIM___'             => [ 'required' ],
            'Prodi___'           => [ 'required' ],
            'Fakultas___'        => [ 'required' ],
            'DPL___'             => [ 'nullable' ],
        ] );

        $user           = new User ();
        $user->email    = $request->Email___;
        $user->password = Hash::make ( $request->Password___ );

        $mahasiswa                   = new Mahasiswa ();
        $mahasiswa->nama_ketua       = $request->NamaKetua___;
        $mahasiswa->anggota_kelompok = $request->AnggotaKelompok___;
        $mahasiswa->nim              = $request->NIM___;
        $mahasiswa->prodi            = $request->Prodi___;
        $mahasiswa->fakultas         = $request->Fakultas___;
        if ( $request->DPL___ != 'null' )
        {
            $mahasiswa->dpl_id = $request->DPL___;
        }

        $mahasiswa->save ();
        $user->save ();

        $user->mahasiswa_id = $mahasiswa->id;
        $mahasiswa->user_id = $user->id;

        $mahasiswa->save ();
        $user->save ();

        if ( $request->DPL___ != 'null' )
        {
            Dpl::where ( 'id', $request->DPL___ )->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );
        }

        return redirect ()->route ($this->mainRoute)->with ( 'success', 'Data Kelompok Baru Berhasil Ditambahkan!' );
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $dpl_kosong   = DPL::with ( 'user' )->where ( 'mahasiswa_id', null )->get ();
        $dpl_sekarang = DPL::with ( 'user' )->where ( 'mahasiswa_id', $mahasiswa->id )->get ()->first ();

        return view ( 'admin.kelompok_mahasiswa.edit', [
            'navActiveItem' => 'data_kelompok_mahasiswa',
            'mahasiswa'     => $mahasiswa,
            'dpl_kosong'    => $dpl_kosong,
            'dpl_sekarang'  => $dpl_sekarang,
        ] );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate ( [
            'NamaKetua___'       => [ 'required' ],
            'Email___'           => [ 'required', 'email' ],
            'Password___'        => [ 'min:6', 'nullable' ],
            'AnggotaKelompok___' => [ 'required' ],
            'NIM___'             => [ 'required' ],
            'Prodi___'           => [ 'required' ],
            'Fakultas___'        => [ 'required' ],
            'DPL___'             => [ 'nullable' ],
            'DPL_Sebelumnya___'  => [ 'nullable' ],
        ] );

        $user      = User::find ( $mahasiswa->user_id );

        $mahasiswa->update ( [
            'nama_ketua'       => $request->NamaKetua___,
            'anggota_kelompok' => $request->AnggotaKelompok___,
            'nim'              => $request->NIM___,
            'prodi'            => $request->Prodi___,
            'fakultas'         => $request->Fakultas___,
        ] );

        if ( $request->DPL___ != 'null' )
        {
            $mahasiswa->update ( [
                'dpl_id' => $request->DPL___,
            ] );
            DPL::where ( 'id', $request->DPL___ )->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );
        }
        else
        {
            $mahasiswa->update ( [
                'dpl_id' => null,
            ] );
            DPL::where ( 'id', $request->DPL_Sebelumnya___ )->update ( [ 'mahasiswa_id' => null ] );
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

        $mahasiswa->save ();
        $user->save ();

        return redirect ()->route ($this->mainRoute)->with ( 'success', 'Data Kelompok Berhasil Diubah!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $user      = User::find ( $mahasiswa->user_id );

        //delete data mahasiswa dan data user
        $mahasiswa->delete ();
        $user->delete ();

        return redirect ()->route ($this->mainRoute)->with ( 'success', 'Data Kelompok Berhasil Dihapus!' );
    }

    public function getData(Request $request)
    {
        $perPage = 25;
        $page    = $request->input ( 'page', 1 );

        // Get the records for the current page
        $dataMahasiswa = Mahasiswa::skip ( ( $page - 1 ) * $perPage )
            ->with (['user', 'dpl', 'laporan_harians', 'laporan_akhir'])
            ->take ( $perPage + 1 ) // Fetch one extra record to check if there are more records to fetch
            ->latest()
            ->get();

        $nextExists = false;
        if ( $dataMahasiswa->count () > $perPage )
        {
            $nextExists    = true;
            // If there are more records, remove the extra one from the current page
            $dataMahasiswa = $dataMahasiswa->slice ( 0, $perPage );
        }

        return response ()->json ( [ 'DataMahasiswa' => $dataMahasiswa, 'nextExists' => $nextExists ] );
    }

    public function findData(Request $request)
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

    public function lastData()
    {
        $data = Mahasiswa::query (); // Replace 'Model' with your actual model

        $perPage = 25; // Set this to the number of items you want per page

        $count = $data->count ();

        $lastPage = ceil ( $count / $perPage );

        return response ()->json ( [ 'lastPage' => $lastPage ] );
    }
}
