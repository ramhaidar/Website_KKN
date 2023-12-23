<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        return view ( "dpl.laporan_harian.index", [
            'navActiveItem'         => 'laporan_harian',
            'user'                  => $user,
            'sudah_punya_mahasiswa' => $sudah_punya_mahasiswa,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LaporanHarian $laporanHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanHarian $laporanHarian)
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        return view ( "dpl.laporan_harian.edit", [
            'navActiveItem'         => 'laporan_harian',
            'user'                  => $user,
            'laporan_harian'        => $laporanHarian,
            'sudah_punya_mahasiswa' => $sudah_punya_mahasiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanHarian $laporanHarian)
    {
        // Validate the form data
        $request->validate ( [ 
            'solusi' => [ 'required', 'string'],
        ] );

        $laporanHarian->update ( [
            'solusi' => $request->solusi,
        ] );

        // Redirect or respond as needed
        return redirect ()->back ()->with ( 'success', 'Berhasil Memberikan Solusi pada Laporan Harian!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanHarian $laporanHarian)
    {
        //
    }

    public function getData(Request $request)
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'dpl' )->find ( $id );
        $bimbingan = LaporanHarian::with(['mahasiswa'])->where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->latest()->get ();

        return response ()->json ( compact('bimbingan') );
    }
}
