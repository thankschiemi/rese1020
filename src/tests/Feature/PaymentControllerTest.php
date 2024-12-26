<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Stripe\PaymentIntent;
use Tests\TestCase;
use Stripe\Exception\InvalidRequestException;
use Exception;

class PaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_payment_page()
    {
        $response = $this->get(route('payment.page'));
        $response->assertStatus(200);
        $response->assertViewIs('payment');
    }

    public function test_process_payment_success()
    {
        // PaymentIntent モック
        $paymentIntentMock = Mockery::mock('overload:' . PaymentIntent::class);
        $paymentIntentMock->shouldReceive('create')
            ->once()
            ->andReturn((object) [
                'client_secret' => 'test_client_secret',
            ]);

        // テストリクエスト送信
        $response = $this->postJson(route('payment.process'), [
            'payment_method_id' => 'test_payment_method',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'client_secret' => 'test_client_secret',
        ]);
    }
    public function test_process_payment_failure()
    {
        // 一般的な例外をスローするモック
        $paymentIntentMock = Mockery::mock('overload:' . \Stripe\PaymentIntent::class);
        $paymentIntentMock->shouldReceive('create')
            ->once()
            ->andThrow(new \Exception('Invalid API Key provided'));

        // テストリクエスト送信
        $response = $this->postJson(route('payment.process'), [
            'payment_method_id' => 'test_payment_method',
        ]);

        $response->assertStatus(200); // エラーハンドリングにより 200 を期待
        $response->assertJson([
            'success' => false,
            'error' => '決済処理中にエラーが発生しました。',
        ]);
    }
}
