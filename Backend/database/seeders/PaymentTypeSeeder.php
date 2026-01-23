<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_type')->insert([
            [
                'id' => 1,
                'name' => 'Pi Pal',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/PI_PAY_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Bakong',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/BAKONG_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Wing',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/WING_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Smart',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/Smart_Axiata_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Cellcard',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/CELLCARD_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Metfone',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/METFONE_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Paygo',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/PAYGO_KH_CHNL_LOGO.webp',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
