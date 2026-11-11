<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PaymentValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_usd_package_generates_usd_qr(): void
    {
        $game = DB::table('games')->insertGetId(['name' => 'Game']);
        $currency = DB::table('currencies')->insertGetId(['name' => 'US Dollar', 'symbol' => '$']);
        $package = DB::table('topup_packages')->insertGetId(['game_id' => $game, 'currency_id' => $currency, 'price' => 200]);

        $response = $this->getJson('/api/checkout/'.$package)->assertOk();
        $this->assertStringContainsString('5303840', $response->json('qr'));
        $this->assertTrue(\KHQR\BakongKHQR::verify($response->json('qr'))->isValid);
        $this->assertMatchesRegularExpression('/99340013\d{13}0113\d{13}6304[0-9A-F]{4}$/', $response->json('qr'));
        $this->assertSame(md5($response->json('qr')), $response->json('md5'));
        $this->assertEquals((int) substr($response->json('qr'), -21, 13), $response->json('expires_at'));
    }

    public function test_rejected_bakong_credentials_return_a_clear_error(): void
    {
        config(['services.bakong.token' => 'expired-token']);
        Http::fake(['*' => Http::response([], 401)]);
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();
        $game = DB::table('games')->insertGetId(['name' => 'Game']);
        $package = DB::table('topup_packages')->insertGetId(['game_id' => $game, 'price' => 200]);

        $this->actingAs($admin, 'sanctum')->postJson('/api/payment', [
            'topup_package_id' => $package, 'md5' => 'test-md5', 'amount' => '200.00',
        ])->assertStatus(503)->assertJsonPath('message', 'Payment verification credentials were rejected. Please contact the administrator.');
        $this->assertDatabaseCount('payments', 0);
    }

    public function test_verified_transaction_is_saved_with_reference_and_payment_date(): void
    {
        config(['services.bakong.token' => 'test-token', 'services.bakong.account_id' => 'merchant@bank']);
        Http::fake(['*' => Http::response([
            'responseCode' => 0,
            'data' => [
                'hash' => 'transaction-hash', 'toAccountId' => 'merchant@bank',
                'currency' => 'USD', 'amount' => 200, 'createdDateMs' => 1767225600000,
            ],
        ])]);
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();
        $game = DB::table('games')->insertGetId(['name' => 'Game']);
        $currency = DB::table('currencies')->insertGetId(['name' => 'US Dollar', 'symbol' => '$']);
        $package = DB::table('topup_packages')->insertGetId(['game_id' => $game, 'currency_id' => $currency, 'price' => 200]);
        $payload = ['topup_package_id' => $package, 'md5' => 'test-md5', 'amount' => '200.00'];

        $this->actingAs($admin, 'sanctum')->postJson('/api/payment', $payload)
            ->assertCreated()->assertJsonPath('payment.transaction_reference', 'transaction-hash');
        $this->assertDatabaseHas('payments', [
            'transaction_reference' => 'transaction-hash', 'status' => 'paid', 'paid_at' => '2026-01-01',
        ]);
        $this->actingAs($admin, 'sanctum')->postJson('/api/payment', $payload)->assertOk();
        $this->assertDatabaseCount('payments', 1);
    }

    public function test_unconfirmed_transaction_is_not_recorded(): void
    {
        config(['services.bakong.token' => 'test-token']);
        Http::fake(['*' => Http::response(['responseCode' => 1, 'data' => null])]);
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();
        $game = DB::table('games')->insertGetId(['name' => 'Game']);
        $package = DB::table('topup_packages')->insertGetId(['game_id' => $game, 'price' => 200]);

        $this->actingAs($admin, 'sanctum')->postJson('/api/payment', [
            'topup_package_id' => $package, 'md5' => 'test-md5', 'amount' => '200.00',
        ])->assertUnprocessable();
        $this->assertDatabaseCount('payments', 0);
    }

    public function test_decimal_amount_is_accepted_by_validation(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();

        // An invalid package stops the request before it can create a payment.
        $this->actingAs($admin, 'sanctum')->postJson('/api/payment', [
            'topup_package_id' => 999,
            'md5' => '6b0507c5add896a56e4d3d094e225500',
            'amount' => '200.00',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('topup_package_id')
            ->assertJsonMissingValidationErrors('amount');
    }

    public function test_negative_amount_is_rejected(): void
    {
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();

        $this->actingAs($admin, 'sanctum')->postJson('/api/payment', [
            'topup_package_id' => 999,
            'md5' => '6b0507c5add896a56e4d3d094e225500',
            'amount' => '-1.00',
        ])->assertUnprocessable()->assertJsonValidationErrors('amount');
    }
}
