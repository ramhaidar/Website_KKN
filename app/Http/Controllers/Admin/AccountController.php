<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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

        return view ( "admin.account.form", [
            'navActiveItem' => 'akun',
            'user' => $user,
        ] );
    }

    public function updateAccount(Request $request)
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
