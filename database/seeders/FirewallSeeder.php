<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class FirewallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'ip' => 0x7f000000,
                'mask' => 0xffffff00,
                'bitmask' => 0xffffffff,
                'authtype' => 'login,email',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($data as $portion) {
            Facades\DB::table('firewalls')->insert($portion);
        }
    }
}
