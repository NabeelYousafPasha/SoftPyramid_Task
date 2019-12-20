<?php

namespace Tests\Feature\Transaction;

use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function user_can_see_transactions_list()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->get('/transactions')
                    ->assertOk();
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function user_can_create_transaction()
    {
        $this->actingAs(factory(User::class)->create());

        $response = $this->post('/transactions', $this->data());

        $this->assertCount(1, Transaction::all());
    }


    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function transaction_sales_date_is_required()
    {
        $response = $this->post('/transactions', array_merge($this->data(), ['transaction_sales_date' => null]));

        $response->assertSessionHasErrors('transaction_sales_date');
        $this->assertCount(0, Transaction::all());
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function transaction_sales_price_is_required()
    {
        $response = $this->post('/transactions', array_merge($this->data(), ['transaction_sales_price' => null]));

        $response->assertSessionHasErrors('transaction_sales_price');
        $this->assertCount(0, Transaction::all());
    }


    private function data()
    {
        return [
            'transaction_detail' => 'Test Details',
            'user_id' => 2,
            'transaction_status' => 'draft',
            'transaction_sales_date' => date('Y-m-d'),
            'transaction_sales_price' => 1000,
        ];
    }
}
