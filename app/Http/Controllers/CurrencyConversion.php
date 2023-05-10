<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyConversion extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            ['amount' => 1.00, 'from_currency' => 'EUR', 'to_currency' => 'USD', 'converted_amount' => '1.19']
        );
    }
}
