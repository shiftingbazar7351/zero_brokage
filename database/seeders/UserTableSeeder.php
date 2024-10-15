<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $users = [
            [
                'name' => 'Flybizz services pvt ltd',
                'email' => 'riyazerobrokage@gmail.com',
                'password' => bcrypt('riyazerobrokage@gmail.com'),
                'phone_number' => '+12398190255',
                'user_type' => $superAdminRole->id,
                'status' => 1,
            ],
            [
                'name' => 'Zero Brokage',
                'email' => 'admin@example.com',
                'password' => bcrypt('Password@123'),
                'phone_number' => '+12398190255',
                'user_type' => $superAdminRole->id,
                'status' => 1,
            ],
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($value['user_type']);
        }
    }
}
