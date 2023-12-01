<?php

namespace App\Http\Controllers;

use App\Models\Dpl;
use App\Models\User;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DplNavigationController extends Controller
{
    public function beranda_dpl ( Request $request )
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        return view ( "dpl.beranda", [ 
            'navActiveItem' => 'beranda',

            'user'          => $user,
        ] );
    }

    public function dpl_akun ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $user = User::find ( Auth::user ()->id );
            $user->load ( 'mahasiswa', 'dpl' );

            return view ( "dpl.akun", [ 
                'navActiveItem' => 'akun',

                'user'          => $user,
            ] );
        }
        else if ( $request->mode_halaman == 'ubah' )
        {
            $request->validate ( [ 
                'id'                        => [ 'required' ],
                'NamaDosen___'              => [ 'required' ],
                'Email___'                  => [ 'required', 'email' ],
                'NIP___'                    => [ 'required' ],
                'Prodi___'                  => [ 'required' ],
                'Fakultas___'               => [ 'required' ],
                'PasswordLama___'           => [ 'min:6', 'nullable' ],
                'PasswordBaru___'           => [ 'min:6', 'nullable' ],
                'PasswordBaruKonfirmasi___' => [ 'min:6', 'same:PasswordBaru___', 'nullable' ],
            ] );

            $user = User::find ( $request->id );
            $dpl  = Dpl::find ( $user->dpl_id );

            $user->update ( [ 
                'email' => $request->Email___,
            ] );

            $dpl->update ( [ 
                'nama_dosen' => $request->NamaDosen___,
                'nip'        => $request->NIP___,
                'prodi'      => $request->Prodi___,
                'fakultas'   => $request->Fakultas___,
            ] );

            if ( $request->PasswordLama___ != null )
            {
                if ( ! Auth::attempt ( [ 'email' => $request->Email___, 'password' => $request->PasswordLama___ ] ) )
                {
                    return redirect ()->back ()->with ( 'error', 'Password Lama Tidak Sesuai!' );
                }
                else
                {
                    $user->update ( [ 
                        'password' => Hash::make ( $request->PasswordBaru___ ),
                    ] );
                }
            }

            $user->save ();
            $dpl->save ();

            return redirect ()->back ()->with ( 'success', 'Detail Akun Berhasil Diubah!' );
        }
    }

    public function dpl_laporan_harian ( Request $request )
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        if ( ! isset( $request->mode_halaman ) )
        {
            return view ( "dpl.laporan.harian", [ 
                'navActiveItem'         => 'laporan_harian',

                'user'                  => $user,
                'sudah_punya_mahasiswa' => $sudah_punya_mahasiswa,
            ] );
        }
        elseif ( $request->mode_halaman == 'tambah' )
        {
            // Validate the form data
            $request->validate ( [ 
                'mahasiswa_id'   => [ 'required', 'exists:mahasiswas,id' ],
                'hari'           => [ 'required', 'string', 'regex:/^(senin|selasa|rabu|kamis|jumat|sabtu|minggu)$/i' ],
                'tanggal'        => [ 'required', 'date_format:Y-m-d' ],
                'jenis_kegiatan' => [ 'required', 'string' ],
                'tujuan'         => [ 'required', 'string' ],
                'sasaran'        => [ 'required', 'string' ],
                'hambatan'       => [ 'required', 'string' ],
                'solusi'         => [ 'required', 'string' ],
                'dokumentasi'    => [ 'required', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048' ],
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
            $laporan->hari             = $request->hari;
            $laporan->tanggal          = $request->tanggal;
            $laporan->jenis_kegiatan   = $request->jenis_kegiatan;
            $laporan->tujuan           = $request->tujuan;
            $laporan->sasaran          = $request->sasaran;
            $laporan->hambatan         = $request->hambatan;
            $laporan->solusi           = $request->solusi;
            $laporan->dokumentasi_path = $dokumentasiPath;
            $laporan->save ();

            // Save the laporan to the database
            $laporan->save ();

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Harian Berhasil Ditambahkan!' );
        }
        elseif ( $request->mode_halaman == 'ubah' )
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
                'solusi'         => [ 'required', 'string' ],
                'dokumentasi'    => [ 'nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048000' ],
            ] );

            // Find the Laporan instance
            $laporan = LaporanHarian::find ( $request->id );

            // Handle file upload
            if ( $request->hasFile ( 'dokumentasi' ) )
            {
                // Delete old file
                if ( $laporan->dokumentasi_path )
                {
                    Storage::delete ( 'public/' . $laporan->dokumentasi_path );
                }

                $file                      = $request->file ( 'dokumentasi' );
                $originalName              = pathinfo ( $file->getClientOriginalName (), PATHINFO_FILENAME );
                $extension                 = $file->getClientOriginalExtension ();
                $ymd                       = date ( 'Y-m-d', strtotime ( $request->tanggal ) );
                $newFileName               = $originalName . '_' . $ymd . '.' . $extension;
                $dokumentasiPath           = $file->storeAs ( 'dokumentasi/' . $request->mahasiswa_id, $newFileName, 'public' );
                $laporan->dokumentasi_path = $dokumentasiPath;
            }


            // Update the Laporan instance
            $laporan->mahasiswa_id   = $request->mahasiswa_id;
            $laporan->hari           = $request->hari;
            $laporan->tanggal        = $request->tanggal;
            $laporan->jenis_kegiatan = $request->jenis_kegiatan;
            $laporan->tujuan         = $request->tujuan;
            $laporan->sasaran        = $request->sasaran;
            $laporan->hambatan       = $request->hambatan;
            $laporan->solusi         = $request->solusi;
            $laporan->save ();

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Harian Berhasil Diubah!' );
        }
        elseif ( $request->mode_halaman == 'hapus' )
        {
            // Find the Laporan instance
            $laporan = LaporanHarian::find ( $request->id );

            // Delete the Laporan instance
            $laporan->delete ();

            // Delete the file
            if ( $laporan->dokumentasi_path )
            {
                Storage::delete ( 'public/' . $laporan->dokumentasi_path );
            }

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Harian Berhasil Dihapus!' );
        }
    }

    public function dpl_laporan_akhir ( Request $request )
    {
        $user = Auth::user ();
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $user->id );

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        if ( ! isset( $request->mode_halaman ) )
        {
            // Check if a laporan_akhir exists for the currently logged in user
            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->first ();

            return view ( "dpl.laporan.akhir", [ 
                'navActiveItem'   => 'laporan_akhir',

                'user'            => $user,
                'laporan_akhir'   => $laporan_akhir,
                'sudah_punya_dpl' => $sudah_punya_mahasiswa
            ] );
        }
        elseif ( $request->mode_halaman == 'revisi' )
        {
            // Validate the form data
            $request->validate ( [ 
                'revisi_pembimbing' => [ 'required', 'string', 'not in:Belum ada Revisi.' ],
                'mahasiswa_id'      => [ 'required', 'exists:mahasiswas,id' ],
            ] );

            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $request->mahasiswa_id )->first ();

            $laporan_akhir->update ( [ 
                'revisi' => $request->revisi_pembimbing,
            ] );

            // Save the Laporan
            $laporan_akhir->save ();

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Berhasil Memberikan Revisi pada Laporan Akhir!' );
        }
        elseif ( $request->mode_halaman == 'approve' )
        {
            // Validate the form data
            $request->validate ( [ 
                'mahasiswa_id'  => [ 'required', 'exists:mahasiswas,id' ],
                'laporan_akhir' => [ 'file', 'mimes:pdf', 'max:10240' ],
            ] );

            // Find the Laporan instance
            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $request->mahasiswa_id )->first ();

            $laporan_akhir->update ( [ 
                'approved' => true,
            ] );

            // Save the Laporan
            $laporan_akhir->save ();

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Akhir Berhasil Diubah!' );
        }
    }

    public function dpl_sertifikat ( Request $request )
    {
        $id            = Auth::user ()->id;
        $user          = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->first ();

        $sudah_punya_mahasiswa = false;

        if ( $user->dpl->mahasiswa_id != null )
        {
            $sudah_punya_mahasiswa = true;
        }

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->dpl->mahasiswa_id )->count ();

        return view ( "dpl.sertifikat", [ 
            'navActiveItem'         => 'sertifikat',

            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'sudah_punya_mahasiswa' => $sudah_punya_mahasiswa,
        ] );
    }
}
