<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('units')->insert([
            [
                'name' => 'Daimond',
                'note' => 'Default unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Piece',
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gime',
                'note' => 'Weight unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gold',
                'note' => 'Volume unit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Liter',
                'note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
