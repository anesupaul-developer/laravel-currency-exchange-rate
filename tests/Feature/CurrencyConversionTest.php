<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyConversionTest extends TestCase
{
    /**
     * A basic feature test currency conversion.
     */
    public function test_currency_conversion(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('currency.conversion', [
            'amount' => 5.00,
            'from_currency' => 'USD',
            'to_currency' => 'ZAR'
        ]));

        $response->assertOk();
        $response->assertJsonStructure(['amount', 'from_currency', 'to_currency', 'converted_amount']);
    }

    /**
     * A basic feature test get currency rates.
     */
    public function test_get_rates(): void
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('currency.rates'));

        $response->assertStatus(200);
        $response->assertJsonStructure(['data']);
        $response->assertJsonPath('data.USD', 1);
    }
}
