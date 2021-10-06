<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class LocationSeeder extends Seeder
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
                'name' => 'Хранилище загрузок',
                'rel_path' => '/../storage/reception',
                'hidden' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($data as $portion) {
            Facades\DB::table('locations')->insert($portion);
        }
    }
}
