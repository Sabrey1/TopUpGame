<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PaymentsSeeder extends Seeder
{
    public function run(): void
    {
        $orders = DB::table('orders')->pluck('id')->toArray();
        $paymentTypes = DB::table('payment_type')->pluck('id')->toArray();
        $topupPackages = DB::table('topup_packages')->pluck('id')->toArray();

        if (empty($orders) || empty($paymentTypes)) {
            $this->command->info('Orders or Payment Types are missing. Please seed them first!');
            return;
        }

        for ($i = 0; $i < 5; $i++) {
            DB::table('payments')->insert([
                'order_id' => $orders[array_rand($orders)],
                'payment_type_id' => $paymentTypes[array_rand($paymentTypes)],
                'topup_package_id' => $topupPackages ? $topupPackages[array_rand($topupPackages)] : null,
                'amount' => rand(100, 1500) / 100, // Random amount like 1.00 - 15.00
                'transaction_reference' => Str::uuid(),
                'md5' => Str::random(32),
                'status' => ['success', 'pending', 'failed'][array_rand(['success', 'pending', 'failed'])],
                'paid_at' => Carbon::now()->subDays(rand(0, 10)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
