<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'order_code' => 'ORD-' . Str::upper(Str::random(8)),
                'game_id' => 1,
                'package_id' => 1,
                'player_id' => 123456,
                'server_id' => 1,
                'price' => 1.99,
                'payment_method' => 'KHQR',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_code' => 'ORD-' . Str::upper(Str::random(8)),
                'game_id' => 1,
                'package_id' => 2,
                'player_id' => 223344,
                'server_id' => 2,
                'price' => 3.99,
                'payment_method' => 'ABA',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_code' => 'ORD-' . Str::upper(Str::random(8)),
                'game_id' => 2,
                'package_id' => 3,
                'player_id' => 778899,
                'server_id' => 1,
                'price' => 2.50,
                'payment_method' => 'Wing',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_code' => 'ORD-' . Str::upper(Str::random(8)),
                'game_id' => 3,
                'package_id' => 4,
                'player_id' => 998877,
                'server_id' => 3,
                'price' => 5.99,
                'payment_method' => 'KHQR',
                'status' => 'failed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_code' => 'ORD-' . Str::upper(Str::random(8)),
                'game_id' => 4,
                'package_id' => 5,
                'player_id' => 556677,
                'server_id' => 1,
                'price' => 14.99,
                'payment_method' => 'ABA',
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
