<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanHarianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mahasiswa $mahasiswa)
    {
        $mode_halaman = "laporan_harian";
        $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
        $user = User::find ( $mahasiswa->user->id );
        $user->load ( 'mahasiswa', 'dpl' );

        return view ( "admin.laporan_harian.index", [
            'navActiveItem' => 'laporan',
            'mode_halaman'  => $mode_halaman,
            'user'          => $user,
            'mahasiswa'     => $mahasiswa,
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
    public function show(Mahasiswa $mahasiswa, LaporanHarian $laporanHarian)
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
        //
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
