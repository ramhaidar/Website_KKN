<?php

namespace Database\Seeders;

use App\Models\DPL;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DPLSeeder extends Seeder
{
    public function run ()
    {
        $dpl = DPL::create ( [ 
            'nama_dosen' => 'dpl',
            'nip'        => '987654321',
            'prodi'      => 'Teknik Informatika',
            'fakultas'   => 'Fakultas Teknik',
            // Add other admin fields here
        ] );

        User::create ( [ 
            'email'    => 'dpl@gmail.com',
            'password' => Hash::make ( '123456' ),
            'dpl_id'   => $dpl->id,
            // Add other user fields here
        ] );
    }
}
