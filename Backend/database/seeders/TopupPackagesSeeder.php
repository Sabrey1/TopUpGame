<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TopupPackagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('topup_packages')->insert([
            [
                'game_id' => 1,
                'name' => 'ML Diamond Pack 86',
                'description' => 'Get 86 Diamonds for Mobile Legends',
                'image' => 'https://example.com/ml86.png',
                'amount' => 86,
                'price' => 1.99,
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 1,
                'name' => 'ML Diamond Pack 172',
                'description' => 'Get 172 Diamonds for Mobile Legends',
                'image' => 'https://example.com/ml172.png',
                'amount' => 172,
                'price' => 3.99,
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 2,
                'name' => 'Honor of Kings 100 Gems',
                'description' => 'Top up 100 Gems for Honor of Kings',
                'image' => 'https://example.com/hok100.png',
                'amount' => 100,
                'price' => 2.5,
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 3,
                'name' => 'PUBG Mobile 300 UC',
                'description' => 'Top up 300 UC for PUBG Mobile',
                'image' => 'https://example.com/pubg300.png',
                'amount' => 300,
                'price' => 5.99,
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 4,
                'name' => 'Garena Shells 980',
                'description' => 'Get 980 Garena Shells',
                'image' => 'https://example.com/garena980.png',
                'amount' => 980,
                'price' => 14.99,
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 5,
                'name' => 'Zepeto Coins 500',
                'description' => 'Top up 500 Zepeto Coins',
                'image' => 'https://example.com/zepeto500.png',
                'amount' => 500,
                'price' => 9.99,
                'currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
