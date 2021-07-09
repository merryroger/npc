<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class UserSeeder extends Seeder
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
                'name' => 'Merry Roger',
                'email' => 'merry_roger@yahoo.com',
                'passhash' => null,
                'checkhash' => '60fce956f0544bf27c12d2110b3f541d',
                'bip' => 0xffffff,
                'userdir' => 'users/60fce956f0544bf27c12d2110b3f541d',
                'status' => 'valid',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($data as $portion) {
            Facades\DB::table('users')->insert($portion);
        }
    }
}
