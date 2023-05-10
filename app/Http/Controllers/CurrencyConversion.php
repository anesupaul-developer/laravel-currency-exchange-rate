<?php

namespace App\Http\Controllers;

use App\Exceptions\CurrencyConversionException;
use App\Http\Requests\CurrencyConversionRequest;
use App\Services\CurrencyConverterInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CurrencyConversion extends Controller
{
    public function index(CurrencyConversionRequest $conversionRequest, CurrencyConverterInterface $currencyConverter): \Illuminate\Http\JsonResponse
    {
        try {
            $fields = $conversionRequest->validated();
            $convertedAmount = $currencyConverter->convert($fields['amount'], $fields['from_currency'], $fields['to_currency']);

            return response()->json(
                [
                    'amount' => $fields['amount'],
                    'from_currency' => $fields['from_currency'],
                    'to_currency' => $fields['to_currency'],
                    'converted_amount' => $convertedAmount
                ]
            );
        } catch(\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $exception->getMessage()
                ],
                ResponseAlias::HTTP_BAD_GATEWAY
            );
        }
    }

    public function rates(CurrencyConverterInterface $currencyConverter) : \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(['data' => $currencyConverter->getRates()]);
        } catch(\Exception $exception) {
            Log::channel('currencies')->info($exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => CurrencyConversionException::RATES_FAILED_EXCEPTION
                ],
                ResponseAlias::HTTP_BAD_GATEWAY
            );
        }
    }
}
