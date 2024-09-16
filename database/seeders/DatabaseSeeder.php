<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            CountryStateCityTableSeeder::class,
            IpAddressSeeder::class,
        ]);
        // \App\Models\User::factory(40)->create()->each(function ($user) {
        //     $user->assignRole('user');
        // });
        // \App\Models\UserProfile::factory(43)->create();
    }
}
