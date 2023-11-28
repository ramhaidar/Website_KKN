<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MahasiswaNavigationController extends Controller
{
    public function beranda_mahasiswa ( Request $request )
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        return view ( "mahasiswa.beranda", [ 
            'navActiveItem' => 'beranda',

            'user'          => $user,
        ] );
    }

    public function mahasiswa_laporan_harian ( Request $request )
    {
        $id   = Auth::user ()->id;
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );

        $sudah_punya_dpl = false;

        if ( $user->mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }

        if ( ! isset( $request->mode_halaman ) )
        {
            return view ( "mahasiswa.laporan.harian", [ 
                'navActiveItem'   => 'laporan_harian',

                'user'            => $user,
                'sudah_punya_dpl' => $sudah_punya_dpl,
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

    public function mahasiswa_laporan_akhir ( Request $request )
    {
        $user = Auth::user ();
        $user = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $user->id );

        $sudah_punya_dpl = false;

        if ( $user->mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }

        if ( ! isset( $request->mode_halaman ) )
        {
            // Check if a laporan_akhir exists for the currently logged in user
            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

            return view ( "mahasiswa.laporan.akhir", [ 
                'navActiveItem'   => 'laporan_akhir',

                'user'            => $user,
                'laporan_akhir'   => $laporan_akhir,
                'sudah_punya_dpl' => $sudah_punya_dpl
            ] );
        }
        elseif ( $request->mode_halaman == 'tambah' )
        {
            // Validate the form data
            $request->validate ( [ 
                'mahasiswa_id'  => [ 'required', 'exists:mahasiswas,id' ],
                'laporan_akhir' => [ 'required', 'file', 'mimes:pdf', 'max:10240' ],
            ] );

            // Create new Laporan
            // $laporan_akhir               = new LaporanAkhir ();

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
                $laporan_akhirPath        = $file->storeAs ( 'laporan_akhir/' . $request->mahasiswa_id, $newFileName, 'public' );
                $laporan_akhir->file_path = $laporan_akhirPath;
            }

            // Save the Laporan
            $laporan_akhir->save ();

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Akhir Berhasil Ditambahkan!' );
        }
        elseif ( $request->mode_halaman == 'ubah' )
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
                $laporan_akhirPath        = $file->storeAs ( 'laporan_akhir/' . $request->mahasiswa_id, $newFileName, 'public' );
                $laporan_akhir->file_path = $laporan_akhirPath;
            }

            // Save the Laporan
            $laporan_akhir->save ();

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Akhir Berhasil Diubah!' );
        }
        elseif ( $request->mode_halaman == 'hapus' )
        {
            // Validate the form Data
            $request->validate ( [ 
                'mahasiswa_id' => [ 'required', 'exists:mahasiswas,id' ],
            ] );

            // Find the Laporan instance
            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $request->mahasiswa_id )->first ();

            // Delete the Laporan instance
            // $laporan_akhir->delete ();

            // Delete the file
            if ( $laporan_akhir->file_path )
            {
                Storage::delete ( 'public/' . $laporan_akhir->file_path );
            }

            $laporan_akhir->update ( [ 'file_path' => null ] );

            // Redirect or respond as needed
            return redirect ()->back ()->with ( 'success', 'Laporan Akhir Berhasil Dihapus!' );
        }
    }

    public function mahasiswa_sertifikat ( Request $request )
    {
        $id            = Auth::user ()->id;
        $user          = User::with ( 'mahasiswa' )->with ( 'dpl' )->find ( $id );
        $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

        $sudah_punya_dpl = false;

        if ( $user->mahasiswa->dpl_id != null )
        {
            $sudah_punya_dpl = true;
        }

        $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->count ();

        return view ( "mahasiswa.sertifikat", [ 
            'navActiveItem'         => 'sertifikat',

            'user'                  => $user,
            'laporan_akhir'         => $laporan_akhir,
            'jumlah_laporan_harian' => $jumlah_laporan_harian,
            'sudah_punya_dpl'       => $sudah_punya_dpl,
        ] );
    }

    public function mahasiswa_akun ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $user = User::find ( Auth::user ()->id );
            $user->load ( 'mahasiswa', 'dpl' );

            return view ( "mahasiswa.akun", [ 
                'navActiveItem' => 'akun',

                'user'          => $user,
            ] );
        }
        else if ( $request->mode_halaman == 'ubah' )
        {
            $request->validate ( [ 
                'id'                        => [ 'required' ],
                'NamaKetuaKelompok___'      => [ 'required' ],
                'Email___'                  => [ 'required', 'email' ],
                'NIM___'                    => [ 'required' ],
                'AnggotaKelompok___'        => [ 'required' ],
                'Prodi___'                  => [ 'required' ],
                'Fakultas___'               => [ 'required' ],
                'PasswordLama___'           => [ 'min:6', 'nullable' ],
                'PasswordBaru___'           => [ 'min:6', 'nullable' ],
                'PasswordBaruKonfirmasi___' => [ 'min:6', 'same:PasswordBaru___', 'nullable' ],
            ] );

            $user      = User::find ( $request->id );
            $mahasiswa = Mahasiswa::find ( $user->mahasiswa_id );

            $user->update ( [ 
                'email' => $request->Email___,
            ] );

            $mahasiswa->update ( [ 
                'nama_ketua'       => $request->NamaKetuaKelompok___,
                'nim'              => $request->NIM___,
                'anggota_kelompok' => $request->AnggotaKelompok___,
                'prodi'            => $request->Prodi___,
                'fakultas'         => $request->Fakultas___,
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
            $mahasiswa->save ();

            return redirect ()->back ()->with ( 'success', 'Detail Akun Berhasil Diubah!' );
        }
    }
}
