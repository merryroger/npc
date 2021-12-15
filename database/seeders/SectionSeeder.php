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
                'id' => 2,
                'bip' => 0x1,
                'name' => 'activity',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.activity',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'bip' => 0x1,
                'name' => 'anticorruption',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.anticorruption',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'bip' => 0x1,
                'name' => 'news',
                'entry_point' => 'templates.guest.news',
                'gen_view' => 'newspage',
                'template' => 'templates.guest.newspage',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'bip' => 0x1,
                'name' => 'videos',
                'entry_point' => 'templates.guest.videos',
                'gen_view' => 'default',
                'template' => 'templates.guest.videos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'bip' => 0x1,
                'name' => 'documents',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.documents',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'bip' => 0x1,
                'name' => 'publications',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.publications',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'bip' => 0x1,
                'name' => 'history',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.history',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 51,
                'bip' => 0x00ffffff,
                'name' => 'images',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms.collections',
                'template' => 'templates.cms.images',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 52,
                'bip' => 0x00ffffff,
                'name' => 'videos',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms.collections',
                'template' => 'templates.cms.videos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 53,
                'bip' => 0x00ffffff,
                'name' => 'banners',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms.collections',
                'template' => 'templates.cms.banners',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 61,
                'bip' => 0x00ffffff,
                'name' => 'news',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms.desktop',
                'template' => 'templates.cms.news',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 71,
                'bip' => 0x00ffffff,
                'name' => 'locations',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms.references',
                'template' => 'templates.cms.locations',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($data as $portion) {
            Facades\DB::table('sections')->insert($portion);
        }
    }
}
