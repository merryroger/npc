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
            ],
            [
                'id' => 51,
                'bip' => 0x00ffffff,
                'name' => 'photos',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms',
                'template' => 'templates.cms.photos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 52,
                'bip' => 0x00ffffff,
                'name' => 'videos',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms',
                'template' => 'templates.cms.videos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 53,
                'bip' => 0x00ffffff,
                'name' => 'banners',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms',
                'template' => 'templates.cms.banners',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 61,
                'bip' => 0x00ffffff,
                'name' => 'news',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms',
                'template' => 'templates.cms.news',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($data as $portion) {
            Facades\DB::table('sections')->insert($portion);
        }
    }
}
