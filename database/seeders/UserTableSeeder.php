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
                'name' => 'systemadmin',
                'email' => 'admin@flybizz.com',
                'password' => bcrypt('admin@flybizz.com'),
                'phone_number' => '+12398190255',
                'user_type' => 'super_admin',
                'status' => 1,
            ],

            [
                'name' => 'user',
                'email' => 'testing@flybizz.com',
                'password' => bcrypt('testing@flybizz.com'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'user',
                'status' => 1
            ]
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($value['user_type']);
        }
    }

}
