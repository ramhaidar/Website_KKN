<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanAkhir;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanAkhirController extends Controller
{
    public $mainRoute = 'mahasiswa.laporan_akhir.index';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user ();
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $user->id );

        $sudah_punya_dpl = false;

        if ( $user->mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }

        // Check if a laporan_akhir exists for the currently logged in user
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

        return view ( "mahasiswa.laporan_akhir.index", [
            'navActiveItem'   => 'laporan_akhir',
            'user'            => $user,
            'laporan_akhir'   => $laporan_akhir,
            'sudah_punya_dpl' => $sudah_punya_dpl
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
        // Validate the form data
        $request->validate ( [
            'mahasiswa_id'  => [ 'required', 'exists:mahasiswas,id' ],
            'laporan_akhir' => [ 'required', 'file', 'mimes:pdf', 'max:10240' ],
        ] );

        // search or new
        $laporan_akhir               = LaporanAkhir::firstOrCreate ( [
            'mahasiswa_id' => $request->mahasiswa_id,
            'dpl_id'       => $request->dpl_id,
        ] );
        $laporan_akhir->mahasiswa_id = $request->mahasiswa_id;
        $laporan_akhir->dpl_id       = $request->dpl_id;

        // update laporan_akhir_id in mahasiswa table
        $mahasiswa                   = Mahasiswa::find ( $request->mahasiswa_id );
        $mahasiswa->laporan_akhir_id = $laporan_akhir->id;
        $mahasiswa->save ();

        // Handle file upload
        if ( $request->hasFile ( 'laporan_akhir' ) )
        {
            $file                     = $request->file ( 'laporan_akhir' );
            $originalName             = pathinfo ( $file->getClientOriginalName (), PATHINFO_FILENAME );
            $extension                = $file->getClientOriginalExtension ();
            $now                      = now (); // Menggunakan fungsi now() dari Carbon
            $ymd                      = $now->format ( 'Y-m-d' );
            $newFileName              = $originalName . '_' . $ymd . '.' . $extension;
            $laporan_akhirPath     = $file->storeAs('laporan_akhir/' . $request->mahasiswa_id, $newFileName, 'public');
            $laporan_akhir->file_path = $laporan_akhirPath;
        }

        // Save the Laporan
        $laporan_akhir->save ();

        // Redirect or respond as needed
        return redirect()->route($this->mainRoute)->with('success', 'Laporan Akhir Berhasil Ditambahkan!' );
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
            'mahasiswa_id'  => [ 'required', 'exists:mahasiswas,id' ],
            'laporan_akhir' => [ 'file', 'mimes:pdf', 'max:10240' ],
        ] );

        // Find the Laporan instance
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $request->mahasiswa_id )->first ();

        // Delete the old Laporan from Storage
        if ( $laporan_akhir->file_path )
        {
            Storage::delete ( 'public/' . $laporan_akhir->file_path );
        }

        // Update the Laporan instance
        if ( $request->hasFile ( 'laporan_akhir' ) )
        {
            $file                     = $request->file ( 'laporan_akhir' );
            $originalName             = pathinfo ( $file->getClientOriginalName (), PATHINFO_FILENAME );
            $extension                = $file->getClientOriginalExtension ();
            $now                      = now (); // Menggunakan fungsi now() dari Carbon
            $ymd                      = $now->format ( 'Y-m-d' );
            $newFileName              = $originalName . '_' . $ymd . '.' . $extension;
            $laporan_akhirPath     = $file->storeAs('laporan_akhir/' . $request->mahasiswa_id, $newFileName, 'public');
            $laporan_akhir->file_path = $laporan_akhirPath;
        }

        // Save the Laporan
        $laporan_akhir->save ();

        // Redirect or respond as needed
        return redirect()->route($this->mainRoute)->with('success', 'Laporan Akhir Berhasil Diubah!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanAkhir $laporanAkhir)
    {
        // Delete the file
        if ( $laporanAkhir->file_path )
        {
            Storage::delete ( 'public/' . $laporanAkhir->file_path );
        }

        $laporanAkhir->update ( [ 'file_path' => null ] );

        // Redirect or respond as needed
        return redirect()->route($this->mainRoute)->with('success', 'Laporan Akhir Berhasil Dihapus!' );
    }
}
