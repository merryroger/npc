<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades;

class MenuitemSeeder extends Seeder
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
                'access_group_id' => 0,
                'node' => 1,
                'mode' => 1,
                'level' => 0,
                'parent' => 0,
                'order' => 1,
                'purpose' => 'main',
                'mnemo' => 'home',
                'url' => '/',
                'section_id' => 1,
                'hidden' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 2,
                'mode' => 2,
                'level' => 0,
                'parent' => 0,
                'order' => 2,
                'purpose' => 'main',
                'mnemo' => 'activity',
                'url' => '/activity',
                'section_id' => 2,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 3,
                'mode' => 3,
                'level' => 0,
                'parent' => 0,
                'order' => 3,
                'purpose' => 'main',
                'mnemo' => 'architecture',
                'url' => '/architecture',
                'section_id' => 3,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 4,
                'mode' => 4,
                'level' => 0,
                'parent' => 0,
                'order' => 4,
                'purpose' => 'main',
                'mnemo' => 'archeology',
                'url' => '/archeology',
                'section_id' => 4,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 5,
                'mode' => 5,
                'level' => 0,
                'parent' => 0,
                'order' => 5,
                'purpose' => 'main',
                'mnemo' => 'contacts',
                'url' => '/contacts',
                'section_id' => 5,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 6,
                'mode' => 6,
                'level' => 0,
                'parent' => 0,
                'order' => 6,
                'purpose' => 'extra',
                'mnemo' => 'anticorruption',
                'url' => '/anticorruption',
                'section_id' => 6,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 7,
                'mode' => 7,
                'level' => 0,
                'parent' => 0,
                'order' => 7,
                'purpose' => 'extra',
                'mnemo' => 'about',
                'url' => '/about',
                'section_id' => 7,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 8,
                'mode' => 8,
                'level' => 0,
                'parent' => 0,
                'order' => 8,
                'purpose' => 'extra',
                'mnemo' => 'news',
                'url' => '/news',
                'section_id' => 8,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 9,
                'mode' => 9,
                'level' => 0,
                'parent' => 0,
                'order' => 9,
                'purpose' => 'collections',
                'mnemo' => 'photos',
                'url' => '/photos',
                'section_id' => 9,
                'hidden' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 10,
                'mode' => 10,
                'level' => 0,
                'parent' => 0,
                'order' => 10,
                'purpose' => 'collections',
                'mnemo' => 'videos',
                'url' => '/videos',
                'section_id' => 10,
                'hidden' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 11,
                'mode' => 11,
                'level' => 0,
                'parent' => 0,
                'order' => 11,
                'purpose' => 'search',
                'mnemo' => 'search',
                'url' => '/search',
                'section_id' => 11,
                'hidden' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 2,
                'mode' => 1,
                'level' => 1,
                'parent' => 2,
                'order' => 1,
                'purpose' => 'submenu',
                'mnemo' => 'documents',
                'url' => '/documents',
                'section_id' => 12,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 2,
                'mode' => 2,
                'level' => 1,
                'parent' => 2,
                'order' => 2,
                'purpose' => 'submenu',
                'mnemo' => 'publications',
                'url' => '/publications',
                'section_id' => 13,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 2,
                'mode' => 3,
                'level' => 1,
                'parent' => 2,
                'order' => 3,
                'purpose' => 'submenu',
                'mnemo' => 'history',
                'url' => '/history',
                'section_id' => 14,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 3,
                'mode' => 1,
                'level' => 1,
                'parent' => 3,
                'order' => 1,
                'purpose' => 'submenu',
                'mnemo' => 'buildings',
                'url' => '/buildings',
                'section_id' => 15,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 3,
                'mode' => 2,
                'level' => 1,
                'parent' => 3,
                'order' => 2,
                'purpose' => 'submenu',
                'mnemo' => 'restoration',
                'url' => '/restoration',
                'section_id' => 16,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 3,
                'mode' => 3,
                'level' => 1,
                'parent' => 3,
                'order' => 3,
                'purpose' => 'submenu',
                'mnemo' => 'temples',
                'url' => '/temples',
                'section_id' => 17,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 4,
                'mode' => 1,
                'level' => 1,
                'parent' => 4,
                'order' => 1,
                'purpose' => 'submenu',
                'mnemo' => 'archeodept',
                'url' => '/archeodept',
                'section_id' => 18,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'access_group_id' => 0,
                'node' => 4,
                'mode' => 2,
                'level' => 1,
                'parent' => 4,
                'order' => 2,
                'purpose' => 'submenu',
                'mnemo' => 'researchist',
                'url' => '/researchist',
                'section_id' => 19,
                'hidden' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($data as $portion) {
            Facades\DB::table('menuitems')->insert($portion);
        }
    }
}