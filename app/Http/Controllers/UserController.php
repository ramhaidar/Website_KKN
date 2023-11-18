<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login ( Request $request )
    {
        // Validate the form data
        $request->validate ( [ 
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ] );

        // Check if 'remember-me' checkbox is checked
        $remember = $request->has ( 'remember-me' );

        // Attempt to log the user in
        if ( Auth::attempt ( [ 'email' => $request->email, 'password' => $request->password ], $remember ) )
        {
            // If successful, check the user's role and redirect accordingly
            if ( Auth::user ()->admin_id != null )
            {
                return redirect ()->route ( 'beranda_admin' )->with ( 'success', 'Berhasil Login Sebagai Admin!' );
            }
            elseif ( Auth::user ()->mahasiswa_id != null )
            {
                return redirect ()->route ( 'beranda_mahasiswa' )->with ( 'success', 'Berhasil Login Sebagai Mahasiswa!' );
            }
            elseif ( Auth::user ()->dpl_id != null )
            {
                return redirect ()->route ( 'beranda_dpl' )->with ( 'success', 'Berhasil Login Sebagai Dosen Pembimbing Lapangan!' );
            }
        }

        // If unsuccessful, redirect back to the login form.
        return redirect ()->back ()->withInput ( $request->only ( 'email' ) )->with ( 'error', 'Detail login tidak valid!' );
    }

}
