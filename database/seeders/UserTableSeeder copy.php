<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'username' => 'systemadmin',
                'email' => 'testing@gmail.com',
                'password' => bcrypt('testing@gmail.com'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'super_admin',
                'status' => 'active',
            ],

            // [
            //     'first_name' => 'John',
            //     'last_name' => 'User',
            //     'username' => 'user',
            //     'email' => 'user@example.com',
            //     'password' => bcrypt('password@123'),
            //     'phone_number' => '+12398190255',
            //     'email_verified_at' => now(),
            //     'user_type' => 'user',
            //     'status' => 'inactive'
            // ]
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($value['user_type']);
        }
    }
}
