<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GamesSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            [
                'name' => 'Mobile Legends: Bang Bang',
                'slug' => Str::slug('Mobile Legends: Bang Bang'),
                'description' => 'Popular MOBA mobile game',
                'image' => 'https://i.pinimg.com/474x/d9/a1/69/d9a169b14075e076a38698a0fd1e0b7e.jpg',
                'is_popular' => true,
                'is_new' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Honor of Kings',
                'slug' => Str::slug('Honor of Kings'),
                'description' => 'Top multiplayer online battle arena game',
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles-plain/Honor-of-Kings-Tile.png',
                'is_popular' => true,
                'is_new' => true,
                'is_active' => true,
            ],
            [
                'name' => 'PUBG Mobile',
                'slug' => Str::slug('PUBG Mobile'),
                'description' => 'Popular battle royale mobile game',
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/pubgm_tile_aug2024.jpg',
                'is_popular' => true,
                'is_new' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Garena Shells',
                'slug' => Str::slug('Garena Shells'),
                'description' => 'Virtual currency for Garena games',
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/garena_shells_tile.jpg',
                'is_popular' => false,
                'is_new' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Zepeto',
                'slug' => Str::slug('Zepeto'),
                'description' => 'Social avatar app',
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/zepeto_tile.png',
                'is_popular' => false,
                'is_new' => true,
                'is_active' => true,
            ],
            [
                'name' => 'EA FC',
                'slug' => Str::slug('EA FC'),
                'description' => 'Football simulation game',
                'image' => 'https://cdn1.codashop.com/S/content/mobile/images/product-tiles/EA_FC_Oct_2025.png',
                'is_popular' => true,
                'is_new' => true,
                'is_active' => true,
            ],
        ];

        // Add timestamps automatically
        $games = array_map(function ($game) {
            $game['created_at'] = now();
            $game['updated_at'] = now();
            return $game;
        }, $games);

        DB::table('games')->insert($games);
    }
}
