<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $paymentTypes = [
            [
                'name' => 'Pi Pal',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/PI_PAY_KH_CHNL_LOGO.webp',
                'description' => 'Global online payment system for secure transactions',
            ],
            [
                'name' => 'Bakong',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/BAKONG_KH_CHNL_LOGO.webp',
                'description' => 'Cambodian national digital payment platform',
            ],
            [
                'name' => 'Wing',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/WING_KH_CHNL_LOGO.webp',
                'description' => 'Mobile wallet and financial services provider in Cambodia',
            ],
            [
                'name' => 'Smart',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/Smart_Axiata_KH_CHNL_LOGO.webp',
                'description' => 'Telecom service with mobile payment solutions',
            ],
            [
                'name' => 'Cellcard',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/CELLCARD_KH_CHNL_LOGO.webp',
                'description' => 'Mobile operator offering payment and top-up services',
            ],
            [
                'name' => 'Metfone',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/METFONE_KH_CHNL_LOGO.webp',
                'description' => 'Cambodian telecom provider with digital payment options',
            ],
            [
                'name' => 'Paygo',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/mno/PAYGO_KH_CHNL_LOGO.webp',
                'description' => 'Payment service provider for fast and easy transactions',
            ],
        ];

        // Add timestamps automatically
        $paymentTypes = array_map(function ($type) {
            $type['created_at'] = now();
            $type['updated_at'] = now();
            return $type;
        }, $paymentTypes);

        DB::table('payment_type')->insert($paymentTypes);
    }
}
