<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DaftarMahasiswa;
use App\Providers\RouteServiceProvider;
use App\Traits\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        $this->middleware ( 'guest' );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator ( array $data )
    {
        return Validator::make ( $data, [ 
            'Nama___'     => [ 'required', 'string', 'max:255' ],
            'NIM___'      => [ 'required', 'string', 'max:255', 'unique:daftar_mahasiswa,nim' ],
            // 'Email___'    => [ 'required', 'string', 'email', 'max:255', 'unique:users,email' ],
            'Fakultas___' => [ 'required', 'string', 'max:255' ],
            'Prodi___'    => [ 'required', 'string', 'max:255' ],
            'Periode___'  => [ 'required', 'string', 'max:255' ],
            // 'Password___'            => [ 'required', 'string', 'min:6', 'confirmed' ],
            // 'Password_Konfirmasi___' => [ 'required', 'same:PasswordBaru___', 'min:6',],
        ] );
    }

    protected function create ( array $data )
    {
        return DaftarMahasiswa::create ( [ 
            'nama'     => $data[ 'Nama___' ],
            'nim'      => $data[ 'NIM___' ],
            'fakultas' => $data[ 'Fakultas___' ],
            'prodi'    => $data[ 'Prodi___' ],
            'periode'  => $data[ 'Periode___' ],
            // 'password' => Hash::make ( $data[ 'Password___' ] ),

            // 'name'     => $data[ 'name' ],
            // 'email'    => $data[ 'email' ],
            // 'password' => Hash::make ( $data[ 'password' ] ),
        ] );
    }
}
