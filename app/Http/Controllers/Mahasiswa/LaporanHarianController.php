<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanHarianController extends Controller
{
    public $mainRoute = 'mahasiswa.laporan_harian.index';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );

        $sudah_punya_dpl = false;

        if ( $user->mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }
        return view ( "mahasiswa.laporan_harian.index", [
            'navActiveItem'   => 'laporan_harian',

            'user'            => $user,
            'sudah_punya_dpl' => $sudah_punya_dpl,
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
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );

        // Validate the form data
        $request->validate ( [
            'mahasiswa_id'   => [ 'required', 'exists:mahasiswas,id' ],
            'hari'           => [ 'required', 'string', 'regex:/^(senin|selasa|rabu|kamis|jumat|sabtu|minggu)$/i' ],
            'tanggal'        => [ 'required', 'date_format:Y-m-d' ],
            'jenis_kegiatan' => [ 'required', 'string' ],
            'tujuan'         => [ 'required', 'string' ],
            'sasaran'        => [ 'required', 'string' ],
            'hambatan'       => [ 'required', 'string' ],
            'tempat'         => [ 'required', 'string' ],
            'dokumentasi'    => [ 'sometimes', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048' ],
        ] );

        // Handle file upload
        $file            = $request->file ( 'dokumentasi' );
        $originalName    = pathinfo ( $file->getClientOriginalName (), PATHINFO_FILENAME );
        $extension       = $file->getClientOriginalExtension ();
        $ymd             = date ( 'Y-m-d', strtotime ( $request->tanggal ) );
        $newFileName     = $originalName . '_' . $ymd . '.' . $extension;
        $dokumentasiPath = $file->storeAs ( 'dokumentasi/' . $request->mahasiswa_id, $newFileName, 'public' );

        // Create or update a Laporan instance
        $laporan                   = new LaporanHarian ();
        $laporan->mahasiswa_id     = $request->mahasiswa_id;
        $laporan->dpl_id           = $user->mahasiswa->dpl_id;
        $laporan->hari             = $request->hari;
        $laporan->tanggal          = $request->tanggal;
        $laporan->jenis_kegiatan   = $request->jenis_kegiatan;
        $laporan->tujuan           = $request->tujuan;
        $laporan->sasaran          = $request->sasaran;
        $laporan->hambatan         = $request->hambatan;
        $laporan->tempat           = $request->tempat;
        $laporan->dokumentasi_path = $dokumentasiPath;
        $laporan->save ();

        // Save the laporan to the database
        $laporan->save ();

        // Redirect or respond as needed
        return redirect()->route($this->mainRoute)->with('success', 'Laporan Harian Berhasil Ditambahkan!' );
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanHarian $laporanHarian)
    {
        // Validate the form data
        $request->validate ( [
            'id'             => [ 'required', 'exists:laporan_harians,id' ],
            'mahasiswa_id'   => [ 'required', 'exists:mahasiswas,id' ],
            'hari'           => [ 'required', 'string', 'regex:/^(senin|selasa|rabu|kamis|jumat|sabtu|minggu)$/i' ],
            'tanggal'        => [ 'required', 'date_format:Y-m-d' ],
            'jenis_kegiatan' => [ 'required', 'string' ],
            'tujuan'         => [ 'required', 'string' ],
            'sasaran'        => [ 'required', 'string' ],
            'hambatan'       => [ 'required', 'string' ],
            'tempat'         => [ 'required', 'string' ],
            'dokumentasi'    => [ 'nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048000' ],
        ] );

        // Handle file upload
        if ( $request->hasFile ( 'dokumentasi' ) )
        {
            // Delete old file
            if ( $laporanHarian->dokumentasi_path )
            {
                Storage::delete ( 'public/' . $laporanHarian->dokumentasi_path );
            }

            $file                      = $request->file ( 'dokumentasi' );
            $originalName              = pathinfo ( $file->getClientOriginalName (), PATHINFO_FILENAME );
            $extension                 = $file->getClientOriginalExtension ();
            $ymd                       = date ( 'Y-m-d', strtotime ( $request->tanggal ) );
            $newFileName               = $originalName . '_' . $ymd . '.' . $extension;
            $dokumentasiPath         = $file->storeAs('dokumentasi/' . $request->mahasiswa_id, $newFileName, 'public');
            $laporanHarian->dokumentasi_path = $dokumentasiPath;
        }

        // Update the Laporan instance
        $laporanHarian->mahasiswa_id   = $request->mahasiswa_id;
        $laporanHarian->hari           = $request->hari;
        $laporanHarian->tanggal        = $request->tanggal;
        $laporanHarian->jenis_kegiatan = $request->jenis_kegiatan;
        $laporanHarian->tujuan         = $request->tujuan;
        $laporanHarian->sasaran        = $request->sasaran;
        $laporanHarian->hambatan       = $request->hambatan;
        $laporanHarian->tempat         = $request->tempat;
        $laporanHarian->save ();

        // Redirect or respond as needed
        return redirect()->route($this->mainRoute)->with('success', 'Laporan Harian Berhasil Diubah!' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanHarian $laporanHarian)
    {
        // Delete the Laporan instance
        $laporanHarian->delete ();

        // Delete the file
        if ( $laporanHarian->dokumentasi_path )
        {
            Storage::delete ( 'public/' . $laporanHarian->dokumentasi_path );
        }

        // Redirect or respond as needed
        return redirect()->route($this->mainRoute)->with('success', 'Laporan Harian Berhasil Dihapus!' );
    }

    public function getData(Request $request)
    {
        $user    = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $request->id );
        $laporan = LaporanHarian::where('mahasiswa_id', $user->mahasiswa->id)
            ->where('tanggal', $request->tanggal)
            ->get();

        return response ()->json ( $laporan );
    }

    public function getMonth(Request $request)
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
}
