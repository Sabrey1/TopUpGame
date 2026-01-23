<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GamesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('games')->insert([
            [
                'id' => 1,
                'name' => 'Mobile Legends: Bang Bang',
                'slug' => Str::slug('Mobile Legends: Bang Bang'),
                'image' => 'https://i.pinimg.com/474x/d9/a1/69/d9a169b14075e076a38698a0fd1e0b7e.jpg',
                'is_popular' => 1,
                'is_new' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Honor of Kings',
                'slug' => Str::slug('Honor of Kings'),
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles-plain/Honor-of-Kings-Tile.png',
                'is_popular' => 1,
                'is_new' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'PUBG Mobile',
                'slug' => Str::slug('PUBG Mobile'),
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_tile_aug2024.jpg',
                'is_popular' => 1,
                'is_new' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Garena Shells',
                'slug' => Str::slug('Garena Shells'),
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg',
                'is_popular' => 0,
                'is_new' => 0,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Zepeto',
                'slug' => Str::slug('Zepeto'),
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/zepeto_tile.png',
                'is_popular' => 0,
                'is_new' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'EA FC',
                'slug' => Str::slug('EA FC'),
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/EA_FC_Oct_2025.png',
                'is_popular' => 1,
                'is_new' => 1,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
