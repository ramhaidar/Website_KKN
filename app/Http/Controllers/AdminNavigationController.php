<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminNavigationController extends Controller
{
    public function beranda_admin ( Request $request )
    {
        $jumlah_mahasiswa = Mahasiswa::count ();
        $jumlah_dpl       = DPL::count ();
        $last5_mahasiswa  = Mahasiswa::orderBy ( 'id', 'desc' )->with ( 'user' )->take ( 5 )->get ();
        $last5_dpl        = DPL::orderBy ( 'id', 'desc' )->with ( 'user' )->take ( 5 )->get ();

        return view ( "admin.beranda", [ 
            'navActiveItem'    => 'beranda',

            'jumlah_mahasiswa' => $jumlah_mahasiswa,
            'jumlah_dpl'       => $jumlah_dpl,
            'last5_mahasiswa'  => $last5_mahasiswa,
            'last5_dpl'        => $last5_dpl,
        ] );
    }

    public function beranda_dpl ( Request $request )
    {
        return view ( "dpl.beranda" );
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

    public function admin_laporan_harian ( Request $request )
    {
        return view ( "admin.laporan.harian", [ 
            'navActiveItem' => 'laporan_harian',
        ] );
    }

    public function admin_laporan_akhir ( Request $request )
    {
        return view ( "admin.laporan.akhir", [ 
            'navActiveItem' => 'laporan_akhir',
        ] );
    }

    public function admin_sertifikat ( Request $request )
    {
        return view ( "admin.sertifikat", [ 
            'navActiveItem' => 'sertifikat',
        ] );
    }

    public function admin_akun ( Request $request )
    {
        if ( ! isset( $request->mode_halaman ) )
        {
            $user = Auth::user ()->with ( 'admin' )->with ( 'mahasiswa' )->with ( 'dpl' )->first ();

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

            return redirect ()->back ()->with ( 'success', 'Detail Akun Berhasil Diubah!' );
        }
    }

}
