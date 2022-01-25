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
                'id' => 3,
                'bip' => 0x1,
                'name' => 'architecture',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.architecture',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'bip' => 0x1,
                'name' => 'archeology',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.archeology',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'bip' => 0x1,
                'name' => 'contacts',
                'entry_point' => 'templates.guest.contacts',
                'gen_view' => 'default',
                'template' => 'templates.guest.contacts',
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
                'id' => 7,
                'bip' => 0x1,
                'name' => 'about',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.about',
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
                'id' => 9,
                'bip' => 0x1,
                'name' => 'photos',
                'entry_point' => 'templates.guest.photos',
                'gen_view' => 'default',
                'template' => 'templates.guest.photos',
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
                'id' => 11,
                'bip' => 0x1,
                'name' => 'search',
                'entry_point' => 'templates.guest.search',
                'gen_view' => 'default',
                'template' => 'templates.guest.search',
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
                'id' => 15,
                'bip' => 0x1,
                'name' => 'buildings',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.buildings',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'bip' => 0x1,
                'name' => 'restoration',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.restoration',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'bip' => 0x1,
                'name' => 'temples',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.temples',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'bip' => 0x1,
                'name' => 'archeodept',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.archeodept',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'bip' => 0x1,
                'name' => 'researchist',
                'entry_point' => 'templates.guest.subpage',
                'gen_view' => 'default',
                'template' => 'templates.guest.researchist',
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
            [
                'id' => 72,
                'bip' => 0x00ffffff,
                'name' => 'tags',
                'entry_point' => 'templates.cms.default',
                'gen_view' => 'cms.references',
                'template' => 'templates.cms.tags',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($data as $portion) {
            Facades\DB::table('sections')->insert($portion);
        }
    }
}
