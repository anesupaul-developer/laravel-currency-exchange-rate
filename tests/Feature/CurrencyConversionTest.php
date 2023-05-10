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
        $response = $this->get(route('currency.conversion', []));

        $response->assertStatus(200);
        $response->assertJsonStructure(['amount', 'from_currency', 'to_currency', 'converted_amount']);
    }
}
