<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Games;
use App\Models\TopUpPackage;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\PanelCoursel;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CurrencySeeder::class,
            UnitSeeder::class,
            UserSeeder::class,
            GamesSeeder::class,
            TopupPackagesSeeder::class,
            PaymentTypeSeeder::class,
            OrdersSeeder::class,
            PaymentsSeeder::class,
            PanelCourselSeeder::class,
            
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    }
}
