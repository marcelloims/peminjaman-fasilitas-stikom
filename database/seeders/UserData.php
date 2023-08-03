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
                'name'                      => 'Sarpras',
                'telephone'                 => '14045',
                'email'                     => 'sarpras@mailinator.com',
                'password'                  => bcrypt('password'),
                'role'                      => 1,
                'created_by'                => 'admin@mailinator.com',
                'updated_by'                => 'admin@mailinator.com'
            ]
        ];
        foreach ($users as $user)
            User::create($user);
    }
}
