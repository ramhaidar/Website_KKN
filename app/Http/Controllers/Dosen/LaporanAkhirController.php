<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user ();
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $user->id );

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        // Check if a laporan_akhir exists for the currently logged in user
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->first ();

        return view ( "dpl.laporan_akhir.index", [ 
            'navActiveItem'   => 'laporan_akhir',
            'user'            => $user,
            'laporan_akhir'   => $laporan_akhir,
            'sudah_punya_dpl' => $sudah_punya_mahasiswa
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
    public function show(LaporanAkhir $laporanAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanAkhir $laporanAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanAkhir $laporanAkhir)
    {
        // Validate the form data
        $request->validate ( [ 
            'revisi_pembimbing' => [ 'required', 'string'],
            'mahasiswa_id'      => [ 'required', 'exists:mahasiswas,id' ],
        ] );

        $laporanAkhir->update ( [
            'revisi' => $request->revisi_pembimbing,
        ] );

        // Redirect or respond as needed
        return redirect ()->back ()->with ( 'success', 'Berhasil Memberikan Revisi pada Laporan Akhir!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanAkhir $laporanAkhir)
    {
        //
    }

    public function approve(LaporanAkhir $laporanAkhir)
    {

        $laporanAkhir->update ( [ 
            'approved' => true,
        ] );

        // Redirect or respond as needed
        return redirect ()->back ()->with ( 'success', 'Laporan Akhir Berhasil Diubah!' );
    }
}
