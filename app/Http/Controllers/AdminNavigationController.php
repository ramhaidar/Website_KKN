<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\LaporanAkhir;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminNavigationController extends Controller
{
    public function beranda_admin(Request $request)
    {
        $navActiveItem = 'beranda';
        $jumlah_mahasiswa = Mahasiswa::count();
        $jumlah_dpl       = DPL::count();
        $last5_mahasiswa  = Mahasiswa::latest()->with ('user')->take(5)->get();
        $last5_dpl        = DPL::latest()->with ('user')->take(5)->get();

        return view ("admin.beranda", compact(
            'navActiveItem',
            'jumlah_mahasiswa',
            'jumlah_dpl',
            'last5_mahasiswa',
            'last5_dpl',
        ));
    }

    public function admin_data_kelompok_mahasiswa ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $jumlah_mahasiswa = Mahasiswa::count ();

            return view ( "admin.data.kelompok_mahasiswa", [
                'navActiveItem'    => 'data_kelompok_mahasiswa',

                'jumlah_mahasiswa' => $jumlah_mahasiswa,
            ] );
        }
        elseif ( $request->mode_halaman == 'tambah' )
        {
            if ( isset( $request->NamaKetua___ ) && isset( $request->Email___ ) && isset( $request->Password___ ) && isset( $request->AnggotaKelompok___ ) && isset( $request->NIM___ ) && isset( $request->Prodi___ ) && isset( $request->Fakultas___ ) && isset( $request->DPL___ ) )
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

                $dpl = DPL::where ( 'id', $request->DPL___ )->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );

                return redirect ()->back ()->with ( 'success', 'Data Kelompok Baru Berhasil Ditambahkan!' );
            }
            else
            {
                $dpl_kosong = DPL::with ( 'user' )->where ( 'mahasiswa_id', null )->get ();

                return view ( "admin.data.kelompok_mahasiswa", [
                    'navActiveItem' => 'data_kelompok_mahasiswa',
                    'mode_halaman'  => 'tambah',

                    'dpl_kosong'    => $dpl_kosong,
                ] );
            }
        }
        elseif ( $request->mode_halaman == 'ubah' )
        {
            if ( isset( $request->NamaKetua___ ) && isset( $request->Email___ ) && isset( $request->AnggotaKelompok___ ) && isset( $request->NIM___ ) && isset( $request->Prodi___ ) && isset( $request->Fakultas___ ) && isset( $request->DPL___ ) )
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

                $mahasiswa = Mahasiswa::find ( $request->id );
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
                    $dpl = DPL::where ( 'id', $request->DPL___ )->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );
                }
                else
                {
                    $mahasiswa->update ( [
                        'dpl_id' => null,
                    ] );
                    $dpl = DPL::where ( 'id', $request->DPL_Sebelumnya___ )->update ( [ 'mahasiswa_id' => null ] );
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

                return redirect ()->back ()->with ( 'success', 'Data Kelompok Berhasil Diubah!' );
            }
            else
            {
                $dpl_kosong   = DPL::with ( 'user' )->where ( 'mahasiswa_id', null )->get ();
                $dpl_sekarang = DPL::with ( 'user' )->where ( 'mahasiswa_id', $request->ID_Ubah )->get ()->first ();

                $selected_mahasiswa = Mahasiswa::with ( 'user' )->find ( $request->ID_Ubah );

                return view ( "admin.data.kelompok_mahasiswa", [
                    'navActiveItem' => 'data_kelompok_mahasiswa',
                    'mode_halaman'  => 'ubah',

                    'mahasiswa'     => $selected_mahasiswa,
                    'dpl_kosong'    => $dpl_kosong,
                    'dpl_sekarang'  => $dpl_sekarang,
                ] );
            }
        }
        elseif ( $request->mode_halaman == 'hapus' )
        {
            $request->validate ( [
                'id' => [ 'required' ],
            ] );

            $mahasiswa = Mahasiswa::find ( $request->id );
            $user      = User::find ( $mahasiswa->user_id );

            //delete data mahasiswa dan data user
            $mahasiswa->delete ();
            $user->delete ();

            return redirect ()->back ()->with ( 'success', 'Data Kelompok Berhasil Dihapus!' );
        }
    }

    public function admin_data_dpl ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $jumlah_dpl = DPL::count ();

            return view ( "admin.data.dpl", [
                'navActiveItem' => 'data_kelompok_mahasiswa',

                'jumlah_dpl'    => $jumlah_dpl,
            ] );
        }
        elseif ( $request->mode_halaman == 'tambah' )
        {
            if ( isset( $request->NamaDPL___ ) && isset( $request->Email___ ) && isset( $request->Password___ ) && isset( $request->NIP___ ) && isset( $request->Prodi___ ) && isset( $request->Fakultas___ ) && isset( $request->KetuaKelompok___ ) )
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

                $mahasiswa = Mahasiswa::where ( 'id', $request->KetuaKelompok___ )->update ( [ 'dpl_id' => $dpl->id ] );

                return redirect ()->back ()->with ( 'success', 'Data Kelompok Baru Berhasil Ditambahkan!' );
            }
            else
            {
                $mahasiswa_kosong = Mahasiswa::with ( 'user' )->where ( 'dpl_id', null )->get ();

                return view ( "admin.data.dpl", [
                    'navActiveItem'    => 'data_kelompok_mahasiswa',
                    'mode_halaman'     => 'tambah',

                    'mahasiswa_kosong' => $mahasiswa_kosong,
                ] );
            }
        }
        elseif ( $request->mode_halaman == 'ubah' )
        {
            if ( isset( $request->NamaDPL___ ) && isset( $request->Email___ ) && isset( $request->NIP___ ) && isset( $request->Prodi___ ) && isset( $request->Fakultas___ ) )
            {
                // dd ( $request );

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

                $dpl  = DPL::find ( $request->id );
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
                    $mahasiswa = Mahasiswa::where ( 'id', $request->KetuaKelompok___ )->update ( [ 'dpl_id' => $dpl->id ] );
                }
                else
                {
                    $dpl->update ( [
                        'mahasiswa_id' => null,
                    ] );
                    $mahasiswa = Mahasiswa::where ( 'id', $request->KetuaKelompok_Sebelumnya___ )->update ( [ 'dpl_id' => null ] );
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

                return redirect ()->back ()->with ( 'success', 'Data Kelompok Berhasil Diubah!' );
            }
            else
            {
                $mahasiswa_kosong   = Mahasiswa::with ( 'user' )->where ( 'dpl_id', null )->get ();
                $mahasiswa_sekarang = Mahasiswa::with ( 'user' )->where ( 'dpl_id', $request->ID_Ubah )->get ()->first ();

                $selected_dpl = DPL::with ( 'user' )->find ( $request->ID_Ubah );

                return view ( "admin.data.dpl", [
                    'navActiveItem'      => 'data_kelompok_mahasiswa',
                    'mode_halaman'       => 'ubah',

                    'dpl'                => $selected_dpl,
                    'mahasiswa_kosong'   => $mahasiswa_kosong,
                    'mahasiswa_sekarang' => $mahasiswa_sekarang,
                ] );
            }
        }
        elseif ( $request->mode_halaman == 'hapus' )
        {
            $request->validate ( [
                'id' => [ 'required' ],
            ] );

            $dpl  = DPL::find ( $request->id );
            $user = User::find ( $dpl->user_id );

            //delete data mahasiswa dan data user
            $dpl->delete ();
            $user->delete ();

            return redirect ()->back ()->with ( 'success', 'Data Kelompok Berhasil Dihapus!' );
        }
    }

    public function admin_laporan ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $jumlah_mahasiswa      = Mahasiswa::count ();
            $jumlah_dpl            = DPL::count ();
            $jumlah_laporan_harian = LaporanHarian::count ();
            $jumlah_laporan_akhir  = LaporanAkhir::count ();

            return view ( "admin.laporan", [
                'navActiveItem'         => 'laporan',

                'jumlah_mahasiswa'      => $jumlah_mahasiswa,
                'jumlah_dpl'            => $jumlah_dpl,
                'jumlah_laporan_harian' => $jumlah_laporan_harian,
                'jumlah_laporan_akhir'  => $jumlah_laporan_akhir,
            ] );
        }
        elseif ( $request->mode_halaman == "laporan_harian" )
        {
            $mode_halaman = "laporan_harian";

            $mahasiswa = Mahasiswa::find ( $request->ID_Mahasiswa );
            $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
            $user = User::find ( $mahasiswa->user->id );
            $user->load ( 'mahasiswa', 'dpl' );

            return view ( "admin.laporan", [
                'navActiveItem' => 'laporan',
                'mode_halaman'  => $mode_halaman,

                'user'          => $user,
            ] );
        }
        elseif ( $request->mode_halaman == "tambah_laporan_harian" )
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
        elseif ( $request->mode_halaman == "ubah_laporan_harian" )
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
        elseif ( $request->mode_halaman == "hapus_laporan_harian" )
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
        elseif ( $request->mode_halaman == "laporan_akhir" )
        {
            $mode_halaman = "laporan_akhir";

            $mahasiswa = Mahasiswa::find ( $request->ID_Mahasiswa );
            $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
            $user = User::find ( $mahasiswa->user->id );
            $user->load ( 'mahasiswa', 'dpl' );

            $sudah_punya_dpl = false;

            if ( $mahasiswa->dpl_id != null )
            {
                $sudah_punya_dpl = true;
            }

            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $user->mahasiswa->id )->first ();

            return view ( "admin.laporan", [
                'navActiveItem' => 'laporan',
                'mode_halaman'  => $mode_halaman,

                'user'          => $user,
                'laporan_akhir' => $laporan_akhir,
            ] );
        }
        elseif ( $request->mode_halaman == "reset_laporan_akhir" )
        {
            $laporan_akhir = LaporanAkhir::where ( 'mahasiswa_id', $request->mahasiswa_id )->firstOrFail ();

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
        else
        {
            dd ( $request );
        }
    }

    public function admin_laporan_akhir ( Request $request )
    {
        return view ( "admin.laporan.akhir", [
            'navActiveItem' => 'laporan_akhir',
        ] );
    }

    public function admin_sertifikat ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $jumlah_mahasiswa  = Mahasiswa::count ();
            $jumlah_dpl        = DPL::count ();
            $jumlah_sertifikat = LaporanAkhir::where ( 'approved', true )->count ();

            return view ( "admin.sertifikat", [
                'navActiveItem'     => 'sertifikat',

                'jumlah_mahasiswa'  => $jumlah_mahasiswa,
                'jumlah_dpl'        => $jumlah_dpl,
                'jumlah_sertifikat' => $jumlah_sertifikat,
            ] );
        }
        else if ( $request->mode_halaman == 'lihat_sertifikat' )
        {
            $mode_halaman = "lihat_sertifikat";

            $mahasiswa = Mahasiswa::find ( $request->ID_Mahasiswa );
            $mahasiswa->load ( 'user', 'dpl', 'laporan_harians', 'laporan_akhir' );
            $user = User::find ( $mahasiswa->user->id );
            $user->load ( 'mahasiswa', 'dpl' );

            $laporan_akhir         = LaporanAkhir::where ( 'mahasiswa_id', $request->ID_Mahasiswa )->firstOrFail ();
            $jumlah_laporan_harian = LaporanHarian::where ( 'mahasiswa_id', $user->mahasiswa->id )->count ();

            return view ( "admin.sertifikat", [
                'navActiveItem'         => 'sertifikat',
                'mode_halaman'          => $mode_halaman,

                'user'                  => $user,
                'laporan_akhir'         => $laporan_akhir,
                'jumlah_laporan_harian' => $jumlah_laporan_harian,
            ] );
        }
        else
        {
            dd ( $request );
        }
    }

    public function admin_akun ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            // $user = Auth::user ()->with ( 'admin' )->with ( 'mahasiswa' )->with ( 'dpl' )->first ();

            $user = User::find ( Auth::user ()->id );
            $user->load ( 'mahasiswa', 'dpl' );

            return view ( "admin.akun", [
                'navActiveItem' => 'akun',

                'user'          => $user,
            ] );
        }
        else if ( $request->mode_halaman == 'ubah' )
        {
            $request->validate ( [
                'id'                        => [ 'required' ],
                'NamaAdmin___'              => [ 'required' ],
                'Email___'                  => [ 'required', 'email' ],
                'PasswordLama___'           => [ 'min:6', 'nullable' ],
                'PasswordBaru___'           => [ 'min:6', 'nullable' ],
                'PasswordBaruKonfirmasi___' => [ 'min:6', 'same:PasswordBaru___', 'nullable' ],
            ] );

            $user  = User::find ( $request->id );
            $admin = Admin::find ( $user->admin_id );

            $user->update ( [
                'email' => $request->Email___,
            ] );

            $admin->update ( [
                'nama' => $request->NamaAdmin___,
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
            $admin->save ();

            return redirect ()->back ()->with ( 'success', 'Detail Akun Berhasil Diubah!' );
        }
    }

    public function mahasiswa_laporan_harian ()
    {
        $navActiveItem = 'laporan_harian';
        return view('admin.bimbingan.harian', compact('navActiveItem'));
    }
}
