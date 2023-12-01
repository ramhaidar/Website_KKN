<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Dpl;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaAndDplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run ()
    {
        $user = User::create ( [ 
            'email'    => 'mahasiswa@gmail.com',
            'password' => Hash::make ( '123456' ),
        ] );

        $mahasiswa = Mahasiswa::create ( [ 
            'nama_ketua'       => 'mahasiswa',
            'anggota_kelompok' => "1. Agus Putra (6404944)\n2. Mahmud Marpaung (6402271)\n3. Cecep Mandala (6404984)\n4. Wulan Sitompul (6401141)\n5. Agus Januar (6402415)",
            'nim'              => '5701054',
            'prodi'            => 'Teknik Informatika',
            'fakultas'         => 'Fakultas Teknik',
            'user_id'          => $user->id,
        ] );

        $user->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );

        $user = User::create ( [ 
            'email'    => 'dpl@gmail.com',
            'password' => Hash::make ( '123456' ),
        ] );

        $dpl = Dpl::create ( [ 
            'nama_dosen' => 'dpl',
            'nip'        => '2023110304054',
            'prodi'      => 'Teknik Informatika',
            'fakultas'   => 'Fakultas Teknik',
            'user_id'    => $user->id,
        ] );

        $user->update ( [ 'dpl_id' => $dpl->id ] );

        $mahasiswa->update ( [ 'dpl_id' => $dpl->id ] );
        $dpl->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );

        $faker = Factory::create ( 'id_ID' ); // use Indonesian locale

        $kodeCabang  = [ '01', '02', '03', '04' ]; // replace with actual values
        $kodeJabatan = [ '01', '02', '03', '04' ]; // replace with actual values
        $kodeProdi   = [ '01', '02', '03', '04' ]; // replace with actual values

        for ( $i = 0; $i < 290; $i++ )
        {

            // Define the values for NIP and NIM components
            $tahun    = date ( 'Y' );
            $bulan    = date ( 'm' );
            $noUrut   = str_pad ( rand ( 1, 999 ), 3, '0', STR_PAD_LEFT );
            $angkatan = rand ( 10, 99 ); // replace with actual value

            $nama_dpl  = $faker->firstName . ' ' . $faker->lastName;
            $email_dpl = strtolower ( str_replace ( ' ', '', $nama_dpl ) ) . mt_rand ( 100, 999 ) . '@gmail.com';

            // Create a new User related to the Dpl
            $user = User::create ( [ 
                // 'email'    => $faker->unique ()->safeEmail,
                'email'    => $email_dpl,
                'password' => Hash::make ( '123456' ),
            ] );

            // Create a new Dpl
            $dpl = Dpl::create ( [ 
                'nama_dosen' => $nama_dpl,
                'nip'        => $tahun . $bulan . $kodeCabang[ array_rand ( $kodeCabang ) ] . $kodeJabatan[ array_rand ( $kodeJabatan ) ] . $noUrut,
                'prodi'      => $faker->randomElement ( [ 'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer' ] ),
                'fakultas'   => $faker->randomElement ( [ 'Fakultas Teknik', 'Fakultas Ilmu Komputer' ] ),
                'user_id'    => $user->id,
            ] );

            $user->update ( [ 'dpl_id' => $dpl->id ] );

            $nama_mahasiswa  = $faker->firstName . ' ' . $faker->lastName;
            $email_mahasiswa = strtolower ( str_replace ( ' ', '', $nama_mahasiswa ) ) . mt_rand ( 100, 999 ) . '@gmail.com';

            // Generate a random number of group members between 4 and 5
            $numMembers = rand ( 4, 5 );

            // Initialize an empty array to hold the group member names
            $groupMembers = [];

            // Generate the group member names
            for ( $j = 0; $j < $numMembers; $j++ )
            {
                $nama_anggota   = $faker->firstName . ' ' . $faker->lastName;
                $nim_anggota    = $angkatan . $kodeProdi[ array_rand ( $kodeProdi ) ] . str_pad ( rand ( 1, 999 ), 3, '0', STR_PAD_LEFT );
                $groupMembers[] = $nama_anggota . ' (' . $nim_anggota . ')';
            }

            // Convert the array of group member names to a string
            $anggota_kelompok = implode ( "\n", array_map ( function ($k, $v)
            {
                return ( $k + 1 ) . '. ' . $v;
            }, array_keys ( $groupMembers ), $groupMembers ) );

            // Create a new User related to the Mahasiswa
            $user = User::create ( [ 
                'email'    => $email_mahasiswa,
                'password' => Hash::make ( '123456' ),
            ] );

            // Create a new Mahasiswa related to the Dpl
            $mahasiswa = Mahasiswa::create ( [ 
                'nama_ketua'       => $nama_mahasiswa,
                'anggota_kelompok' => $anggota_kelompok,
                'nim'              => $angkatan . $kodeProdi[ array_rand ( $kodeProdi ) ] . $noUrut,
                'prodi'            => $faker->randomElement ( [ 'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer' ] ),
                'fakultas'         => $faker->randomElement ( [ 'Fakultas Teknik', 'Fakultas Ilmu Komputer' ] ),
                'user_id'          => $user->id,
            ] );

            $user->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );

            $dpl->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );
            $mahasiswa->update ( [ 'dpl_id' => $dpl->id ] );
        }

        for ( $i = 0; $i < 10; $i++ )
        {

            // Define the values for NIP and NIM components
            $tahun    = date ( 'Y' );
            $bulan    = date ( 'm' );
            $noUrut   = str_pad ( rand ( 1, 999 ), 3, '0', STR_PAD_LEFT );
            $angkatan = rand ( 10, 99 ); // replace with actual value

            $nama_dpl  = $faker->firstName . ' ' . $faker->lastName;
            $email_dpl = strtolower ( str_replace ( ' ', '', $nama_dpl ) ) . mt_rand ( 100, 999 ) . '@gmail.com';

            // Create a new User related to the Dpl
            $user = User::create ( [ 
                // 'email'    => $faker->unique ()->safeEmail,
                'email'    => $email_dpl,
                'password' => Hash::make ( '123456' ),
            ] );

            // Create a new Dpl
            $dpl = Dpl::create ( [ 
                'nama_dosen' => $nama_dpl,
                'nip'        => $tahun . $bulan . $kodeCabang[ array_rand ( $kodeCabang ) ] . $kodeJabatan[ array_rand ( $kodeJabatan ) ] . $noUrut,
                'prodi'      => $faker->randomElement ( [ 'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer' ] ),
                'fakultas'   => $faker->randomElement ( [ 'Fakultas Teknik', 'Fakultas Ilmu Komputer' ] ),
                'user_id'    => $user->id,
            ] );

            $user->update ( [ 'dpl_id' => $dpl->id ] );

            $nama_mahasiswa  = $faker->firstName . ' ' . $faker->lastName;
            $email_mahasiswa = strtolower ( str_replace ( ' ', '', $nama_mahasiswa ) ) . mt_rand ( 100, 999 ) . '@gmail.com';

            // Generate a random number of group members between 4 and 5
            $numMembers = rand ( 4, 5 );

            // Initialize an empty array to hold the group member names
            $groupMembers = [];

            // Generate the group member names
            for ( $j = 0; $j < $numMembers; $j++ )
            {
                $nama_anggota   = $faker->firstName . ' ' . $faker->lastName;
                $nim_anggota    = $angkatan . $kodeProdi[ array_rand ( $kodeProdi ) ] . str_pad ( rand ( 1, 999 ), 3, '0', STR_PAD_LEFT );
                $groupMembers[] = $nama_anggota . ' (' . $nim_anggota . ')';
            }

            // Convert the array of group member names to a string
            $anggota_kelompok = implode ( "\n", array_map ( function ($k, $v)
            {
                return ( $k + 1 ) . '. ' . $v;
            }, array_keys ( $groupMembers ), $groupMembers ) );

            // Create a new User related to the Mahasiswa
            $user = User::create ( [ 
                'email'    => $email_mahasiswa,
                'password' => Hash::make ( '123456' ),
            ] );

            // Create a new Mahasiswa related to the Dpl
            $mahasiswa = Mahasiswa::create ( [ 
                'nama_ketua'       => $nama_mahasiswa,
                'anggota_kelompok' => $anggota_kelompok,
                'nim'              => $angkatan . $kodeProdi[ array_rand ( $kodeProdi ) ] . $noUrut,
                'prodi'            => $faker->randomElement ( [ 'Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer' ] ),
                'fakultas'         => $faker->randomElement ( [ 'Fakultas Teknik', 'Fakultas Ilmu Komputer' ] ),
                'user_id'          => $user->id,
            ] );

            $user->update ( [ 'mahasiswa_id' => $mahasiswa->id ] );
        }
    }
}
