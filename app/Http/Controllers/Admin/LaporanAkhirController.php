<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mahasiswa $mahasiswa)
    {
        $mode_halaman = "laporan_akhir";
        $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
        $user = User::find ( $mahasiswa->user->id );
        $user->load ( 'mahasiswa', 'dpl' );

        $sudah_punya_dpl = false;

        if ( $mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }

        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

        return view ( "admin.laporan.laporan_akhir", [
            'navActiveItem'   => 'laporan',
            'mode_halaman'    => $mode_halaman,
            'user'            => $user,
            'laporan_akhir'   => $laporan_akhir,
            'sudah_punya_dpl' => $sudah_punya_dpl,
            'mahasiswa'       => $mahasiswa,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa, LaporanAkhir $laporanAkhir)
    {
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $mahasiswa->id )->firstOrFail ();

        if ( $laporan_akhir->file_path )
        {
            Storage::delete ( $laporan_akhir->file_path );
        }

        $laporan_akhir->update ( [
            'revisi'    => null,
            'approved'  => false,
            'file_path' => null,
        ] );
        $laporan_akhir->save ();

        return redirect ()->back ()->with ( 'success', 'Laporan Akhir Berhasil Direset!' );
    }
}
