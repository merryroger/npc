<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class SectionSeeder extends Seeder
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
                'bip' => 0x1,
                'name' => 'home',
                'entry_point' => 'templates.guest.default',
                'gen_view' => 'default',
                'template' => 'templates.guest.homepage',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($data as $portion) {
            Facades\DB::table('sections')->insert($portion);
        }
    }
}
