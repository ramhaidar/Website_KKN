<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run ()
    {
        $mahasiswa = Mahasiswa::create ( [ 
            'nama_ketua' => 'mahasiswa',
            'nim'        => '5701054',
            'prodi'      => 'Teknik Informatika',
            'fakultas'   => 'Fakultas Teknik',
            // Add other admin fields here
        ] );

        User::create ( [ 
            'email'        => 'mahasiswa@gmail.com',
            'password'     => Hash::make ( '123456' ),
            'mahasiswa_id' => $mahasiswa->id,
            // Add other user fields here
        ] );
    }
}
