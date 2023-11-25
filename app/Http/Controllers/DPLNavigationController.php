<?php

namespace App\Http\Controllers;

use App\Models\DPL;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DPLNavigationController extends Controller
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
            $dpl  = DPL::find ( $user->dpl_id );

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
}
