<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PanelCourselSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('panel_coursel')->insert([
            [
                'title' => 'Fresh Strawberry',
                'image' => 'https://static.vecteezy.com/system/resources/thumbnails/057/068/323/small/single-fresh-red-strawberry-on-table-green-background-food-fruit-sweet-macro-juicy-plant-image-photo.jpg',
                'description' => 'Juicy and fresh strawberry on a green background.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'MLBB Lucky Draw',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/promos/Dec25/KH_MLBB_X_Wing_Bank_Lucky_Draw_730x280.png',
                'description' => 'Mobile Legends: Bang Bang Lucky Draw promotion.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WingPay Lucky Draw',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/promos/Jan26/WingPayxCodashop-Lucky%20Draw-730x280.jpg',
                'description' => 'Win prizes with WingPay Lucky Draw event!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'EA FC TOTY',
                'image' => 'https://cdn1.codashop.com/S/content/common/images/promos/Jan26/EAFCM_TOTY_KH_730x280.jpg',
                'description' => 'Celebrate EA FC Team of the Year with amazing offers.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
