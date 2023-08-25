<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'                      => 'Ni Nyoman Utami Januhari, SH., M.Kom',
                'telephone'                 => '14045',
                'email'                     => 'sarpras@mailinator.com',
                'category'                  => 'Sarpras',
                'password'                  => bcrypt('password'),
                'role'                      => 1,
                'created_by'                => 'admin@mailinator.com',
                'updated_by'                => 'admin@mailinator.com'
            ],
            [
                'name'                      => 'Badan Eksekutif Mahasiswa',
                'telephone'                 => '14045',
                'email'                     => 'bem@mailinator.com',
                'category'                  => 'BEM',
                'password'                  => bcrypt('password'),
                'role'                      => 2,
                'created_by'                => 'admin@mailinator.com',
                'updated_by'                => 'admin@mailinator.com'
            ],
            [
                'name'                      => 'Erma Sulistyo Rini, S.E., MM.Kom',
                'telephone'                 => '14045',
                'email'                     => 'akademik_kemahasiswaan@mailinator.com',
                'category'                  => 'Akademik dan Kemahasiswaan',
                'password'                  => bcrypt('password'),
                'role'                      => 4,
                'created_by'                => 'admin@mailinator.com',
                'updated_by'                => 'admin@mailinator.com'
            ],
            [
                'name'                      => 'I G.N. Wikranta Arsa, S.Kom., M.Csd',
                'telephone'                 => '14045',
                'email'                     => 'koor_kemahasiswaan@mailinator.com',
                'category'                  => 'Koor. Bagian Kemahasiswaan',
                'password'                  => bcrypt('password'),
                'role'                      => 5,
                'created_by'                => 'admin@mailinator.com',
                'updated_by'                => 'admin@mailinator.com'
            ]
        ];
        foreach ($users as $user)
            User::create($user);
    }
}
