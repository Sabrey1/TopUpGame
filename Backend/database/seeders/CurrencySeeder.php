<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('currencies')->insert([
            [
                'name' => 'US Dollar',
                'symbol' => '$',
                'image' => 'usd.png',
                'presition' => '2',
                'note' => 'USD Currency',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khmer Riel',
                'symbol' => '៛',
                'image' => 'khr.png',
                'presition' => '0',
                'note' => 'Cambodia Currency',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thai Baht',
                'symbol' => '฿',
                'image' => 'thb.png',
                'presition' => '2',
                'note' => 'Thailand Currency',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chinese Yuan',
                'symbol' => '¥',
                'image' => 'cny.png',
                'presition' => '2',
                'note' => 'China Currency',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Euro',
                'symbol' => '€',
                'image' => 'eur.png',
                'presition' => '2',
                'note' => 'EU Currency',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
