<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopupPackagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('topup_packages')->insert([
            [
                'game_id' => 1,
                'name' => 'ML Diamond Pack 86',
                'description' => 'Get 86 Diamonds for Mobile Legends',
                'image' => 'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203562_e4990cee-4020-4a74-8fc2-ae7f68fdabcd.png',
                'amount' => 86,
                'price' => 100,
                'fullprice' => 2.99,
                'best_seller' => 0,
                'discount' => '-23%',
                'unit_id' => 1,       // Replace with the actual ID from your 'units' table
                'currency_id' => 1,   // Replace with the actual ID from your 'currencies' table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 1,
                'name' => 'ML Diamond Pack 172',
                'description' => 'Get 172 Diamonds for Mobile Legends',
                'image' => 'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203009_d549995d-4641-48ed-80d0-c8f6259840f2.png',
                'amount' => 172,
                'price' => 100,
                'fullprice' => 4.99,
                'best_seller' => 0,
                'discount' => '-23%',
                'unit_id' => 1,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 1,
                'name' => 'ML Diamond Pack 172',
                'description' => 'Get 172 Diamonds for Mobile Legends',
                'image' => 'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203286_6878d3f6-b882-4a98-8e79-8d631d7fb683.png',
                'amount' => 172,
                'price' => 200,
                'fullprice' => 4.99,
                'best_seller' => 1,
                'discount' => '-23%',
                'unit_id' => 1,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 1,
                'name' => 'ML Diamond Pack 256',
                'description' => 'Get 256 Diamonds for Mobile Legends',
                'image' => 'https://cdn1.codashop.com/images/106_5e7a01a7-89b9-4b13-a512-a3e72f63f0d1_product/1760335203009_d549995d-4641-48ed-80d0-c8f6259840f2.png',
                'amount' => 256,
                'price' => 200,
                'fullprice' => 6.99,
                'best_seller' => 1,
                'discount' => '-23%',
                'unit_id' => 1,
                'currency_id' => 1,
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
                'fullprice' => 3.5,
                'best_seller' => 0,
                'discount' => '-23%',
                'unit_id' => 2,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'game_id' => 3,
                'name' => 'PUBG Mobile 300 UC',
                'description' => 'Top up 300 UC for PUBG Mobile',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/denom-image/PUBG/325_PUBG_UC.png',
                'amount' => 300,
                'price' => 5.99,
                'fullprice' => 7.99,
                'best_seller' => 0,
                'discount' => '-23%',
                'unit_id' => 3,
                'currency_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Continue for other packages...
        ]);
    }
}
