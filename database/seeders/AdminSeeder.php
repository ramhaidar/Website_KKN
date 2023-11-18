<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run ()
    {
        $admin = Admin::create ( [ 
            'nama' => 'admin',
            // Add other admin fields here
        ] );

        User::create ( [ 
            'email'    => 'admin@gmail.com',
            'password' => Hash::make ( '123456' ),
            'admin_id' => $admin->id,
            // Add other user fields here
        ] );
    }
}
