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
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('Password@123'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'super_admin', // Role for the first user
                'status' => 'active',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@flybizz.com',
                'password' => bcrypt('Flybizz@123'),
                'phone_number' => '+9977882673',
                'email_verified_at' => now(),
                'user_type' => 'super_admin', // Role for the second user
                'status' => 'active',
            ],
        ];

        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($value['user_type']);
        }
    }

}
