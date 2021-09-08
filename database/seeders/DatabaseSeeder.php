<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usergroup;
use App\Models\Pengguna;
use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'usergroupid' => '1',
            'first_name' => 'Jumri',
            'last_name' => 'Habbeyb DS',
            'username' => 'jumrihdees',
            'email' => 'habbeybds@gmail.com',
            'no_hp' => '089525184040',
            'email_verified_at' => now(),
            'password'  => Hash::make('password'),// password
            'remember_token' => Str::random(10),

        ]);
        User::create([
            'usergroupid' => '2',
            'first_name' => 'Rudy Setiawan',
            'last_name' => 'Samosir',
            'username' => 'rudysetiawan',
            'email' => 'rudysetiawan@gmail.com',
            'no_hp' => '08125634345',
            'email_verified_at' => now(),
            'password'  => Hash::make('password'),// password
            'remember_token' => Str::random(10),

        ]);

        Usergroup::create([
            'level' => 'Dinsos',
            'description' => 'Admin Dinas Sosial',
        ]);

        Usergroup::create([
            'level' => 'Agen',
            'description' => 'Agen penyaluran Bansos',
        ]);
        
        Desa::create([
            'desa' => 'Kalang Simbara',
            'kecamatan' => 'Sidikalang',
        ]);

        Pengguna::create([
            'desaid' => '1',
            'nik' => '128324576357349',
            'first_name' => 'Karina',
            'last_name' => 'Surbakti',
            'address' => 'Jln Letda Sujono No 384',
            'email' => 'Karina@gmail.com',
            'no_telp' => '02342423745',
            'dob' => '1998-03-13',
        ]);
        Pengguna::create([
            'desaid' => '1',
            'nik' => '128324598696945',
            'first_name' => 'Dinta',
            'last_name' => 'Pratiwi',
            'address' => 'Jln pancing gg murni No 2',
            'email' => 'dhintae@gmail.com',
            'no_telp' => '08952517674',
            'dob' => '1999-05-18',
        ]);
    }
}
