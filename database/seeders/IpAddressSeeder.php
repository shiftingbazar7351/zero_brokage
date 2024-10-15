<?php

namespace Database\Seeders;

use App\Models\IpAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IpAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ipAddresses = [
            [
                'ip_address' => '180.151',
                'status' => 1,
                'created_at' => now(),
            ],
            [
                'name' => '49.47',
                'status' => 1,
                'created_at' => now(),
            ],

             [
                'name' => '16.171.5.120',
                'status' => 1,
                'created_at' => now(),
            ],
        ];

        // Insert using the model
        IpAddress::insert($ipAddresses);
    }
}
