<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function showAccountForm()
    {
        $user = User::find ( Auth::user ()->id );
        $user->load ( 'mahasiswa', 'dpl' );

        return view ( "mahasiswa.account.form", [
            'navActiveItem' => 'akun',
            'user' => $user,
        ] );
    }

    public function updateAccount(Request $request)
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
