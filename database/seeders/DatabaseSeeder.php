<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Usergroup;
use App\Models\JenisBantuan;
use App\Models\NomorSK;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Penerima;
use App\Models\Barang;
use App\Models\Penyaluran;
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
        User::create([
            'usergroupid' => '2',
            'first_name' => 'Erna',
            'last_name' => 'Wati',
            'username' => 'ernawati',
            'email' => 'ernawati@gmail.com',
            'no_hp' => '08125687545',
            'email_verified_at' => now(),
            'password'  => Hash::make('Nabilah1398'),// password
            'remember_token' => Str::random(10),

        ]);

        Usergroup::create([
            'level' => 'Admin Dinsos',
            'description' => 'Admin Dinas Sosial',
        ]);

        Usergroup::create([
            'level' => 'Agen',
            'description' => 'Agen penyaluran Bansos',
        ]);
        
        Desa::create([
            'kecamatanid' => '1',
            'desa' => 'Kalang Simbara',
        ]);
        Desa::create([
            'kecamatanid' => '1',
            'desa' => 'Huta Rakyat',
        ]);

        JenisBantuan::create([
            'jenis_bantuan' => 'BANSOS SEMBAKO',
            'jumlah_tahapan' => '12',
            'tahun_tahapan' => '2021',
            'status' => 'actived',
        ]);

        // NomorSK::create([
        //     'nomor_sk' => '001/SK/TEST/2021',
        //     'jenisbantuanid' => '1',
        //     'tahapan' => '1',
        //     'status' => 'active',
        // ]);

        // Penerima::create([
        //     'no_skid' => '1',
        //     'nik' => '128324576357349',
        //     'no_kk' => '128324576350001',
        //     'name' => 'Amar Nugraha',
        //     'alamat' => 'JL. PARLUASAN NO. 238',
        //     'desaid' => '1',
        //     'jenis_kelamin' => 'L',
        //     'pekerjaan' => 'BELUM/TIDAK BEKERJA',
        //     'status_kawin' => 'belum kawin',
        //     'dtks' => '-',
        //     'dtks2_kk' => '-',
        //     'jenisbantuanid' => '1',
        //     'nominal_bantuan' => '200000',
        // ]);
            
        Kecamatan::create([
            'kecamatan' => 'Sidikalang',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Berampu',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Sitinjo',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Parbuluan',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Sumbul',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Silahisabungan',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Silima Pungga-pungga',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Lae Parira',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Siempat Nempu',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Siempat Nempu Hulu',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Siempat Nempu Hilir',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Tigalingga',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Gunung Sitember',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Pegagan Hilir',
        ]);
        Kecamatan::create([
            'kecamatan' => 'Tanah Pinem',
        ]);



        Barang::create([
            'agen_id' => '2',
            'kode_barang' => 'BRS',
            'nama_barang' => 'Beras Bulog',
            'satuan' => 'kg',
            'harga' => '50000',
            'stok' => '50',
            'status' => 'pending',
        ]);
        Barang::create([
            'agen_id' => '3',
            'kode_barang' => 'MYG',
            'nama_barang' => 'Minyak Goreng',
            'satuan' => 'ltr',
            'harga' => '50000',
            'stok' => '500',
            'status' => 'pending',
        ]);
        // Penyaluran::create([
        //     'penerima_id' => '2',
        //     'nik' => '1211015905750003',
        //     'barang' => '1,2',
        //     'tgl_penyaluran' => '2021-09-21 09:12:53',
        //     'status' => 'completed',
        // ]);
    }
}
