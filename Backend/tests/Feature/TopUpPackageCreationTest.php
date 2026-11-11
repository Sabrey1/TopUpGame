<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TopUpPackageCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_package_with_an_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();
        $game = DB::table('games')->insertGetId(['name' => 'Game']);
        $currency = DB::table('currencies')->insertGetId(['name' => 'Currency']);
        $unit = DB::table('units')->insertGetId(['name' => 'Unit']);
        $image = UploadedFile::fake()->createWithContent('package.png', base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aXl8AAAAASUVORK5CYII='
        ));

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/topupPackage', [
            'game_id' => $game,
            'name' => 'Package',
            'amount' => 100,
            'fullprice' => 10,
            'currency_id' => $currency,
            'unit_id' => $unit,
            'discount' => '5',
            'image' => $image,
        ]);

        $response->assertOk()->assertJsonPath('topUp.currency_id', $currency);
        $this->assertDatabaseHas('topup_packages', ['name' => 'Package', 'discount' => '5']);
        Storage::disk('public')->assertExists('topUpPackage/'.$image->hashName());
    }

    public function test_invalid_image_returns_validation_error(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();
        $game = DB::table('games')->insertGetId(['name' => 'Game']);
        $currency = DB::table('currencies')->insertGetId(['name' => 'Currency']);
        $unit = DB::table('units')->insertGetId(['name' => 'Unit']);

        $this->actingAs($admin, 'sanctum')->postJson('/api/topupPackage', [
            'game_id' => $game,
            'name' => 'Package',
            'amount' => 100,
            'fullprice' => 10,
            'currency_id' => $currency,
            'unit_id' => $unit,
            'image' => 'not an image',
        ])->assertUnprocessable()->assertJsonValidationErrors('image');
    }
}
