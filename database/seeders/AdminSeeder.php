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
        $user = User::create ( [ 
            'email'    => 'admin@gmail.com',
            'password' => Hash::make ( '123456' ),
            // Add other user fields here
        ] );

        $admin = Admin::create ( [ 
            'nama'    => 'admin',
            'user_id' => $user->id,
        ] );

        $user->update ( [ 'admin_id' => $admin->id ] );
    }
}
