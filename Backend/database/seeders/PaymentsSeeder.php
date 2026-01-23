<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'order_id' => 1,
                'payment_type_id' => 1,
                'amount' => 1.99,
                'transaction_reference' => Str::uuid(),
                'status' => 'success',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'payment_type_id' => 2,
                'amount' => 3.99,
                'transaction_reference' => Str::uuid(),
                'status' => 'pending',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'payment_type_id' => 5,
                'amount' => 2.50,
                'transaction_reference' => Str::uuid(),
                'status' => 'success',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'payment_type_id' => 7,
                'amount' => 5.99,
                'transaction_reference' => Str::uuid(),
                'status' => 'failed',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'payment_type_id' => 6,
                'amount' => 14.99,
                'transaction_reference' => Str::uuid(),
                'status' => 'success',
                'paid_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
